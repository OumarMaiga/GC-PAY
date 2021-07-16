<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Structure;
use App\Models\Service;
use App\Models\Requete;
use App\Models\Impot;
use App\Models\Vignette;
use App\Models\Edm;
use App\Models\CarteIdentite;
use App\Models\Passport;
use App\Models\Somagep;
use App\Models\File;
use App\Models\Notification;
use App\Models\Paiement;

use Session;
use Stripe;

class StripeController extends Controller
{
    function formulaire() {
        $data = session()->get("data");
        return view ('paiements.credit_card', compact('data'));
    }
        

    function process(Request $request) { 
        $data = session()->get("data");
        if (array_key_exists('montant_payer', $data)){
            $montant = $data['montant_payer'];
        }elseif (array_key_exists('montant', $data)){
            $montant = $data['montant'] ;
        }else{
            $montant = Service::findOrFail($data['service_id'])->prix;
        }

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        Stripe\Charge::create ([
            "amount" => $montant,
            "currency" => "xof",
            "source" => $request->stripeToken,
            "description" => "Paiement reçu de GC-PAY"
        ]);
        
        Session::flash('success', 'Paiement effectuée avec succès vous allez recevoir un mail!');
        $this->save_requete();
        Session::forget('data');
        $requete = Requete::where('usager_id', Auth::user()->id)->orderBy('id', 'desc')->first();
        return redirect("usagers/requete/$requete->slug");
        
    }

    function paiementOk() {
        dd("Paiement OK");
    }

    function save_requete() {
        $data = Session::get('data');
        $structure = Structure::findOrFail($data['structure_id']);
        $service = Service::findOrFail($data['service_id']);
        $rubrique = $service->rubrique()->associate($service->rubrique_id)->rubrique;
        
        //Verification si le service et la structure ont un lien dans notre base de données
        if($structure && $service){
            $lien = DB::select('select * from service_structure where service_id = ? && structure_id = ?', [$service->id, $structure->id]);
            if ($lien == null) {
                return redirect("/service/$service->slug")->withErrors("La structure ou le service est mal sélectionné");
            }
        }else{
            return redirect("/service/$service->slug")->withErrors("La structure ou le service est mal sélectionné");
        }
        $slug = 'requete_'.Auth::user()->id.'_'.time();
        $data['slug'] = $slug;
        $data['usager_id'] = Auth::user()->id;
        $data['service_id'] = $service->id;
        $data['structure_id'] = $structure->id;
        $requete = Requete::create($data);
        $data['requete_id'] = $requete->id;

        // Enregistrement dans le table du service en question            
            //Données pour la rubrique impot et taxe
            if($rubrique->slug == "impots-et-taxes"){
                $data['libelle'] = $service->libelle;
                Impot::create($data);
                $montant = $data['montant_payer'];
                $entreprise_id = $data['entreprise_id'];
            }   
            //Données pour la rubrique automobile
            if($rubrique->slug == "automobile"){
                Vignette::create($data);
                $montant = $service->prix;
                $entreprise_id = Null;
            }   
            //Données pour electricité
            if($service->slug == "energie-du-mali"){
                Edm::create($data);
                $montant = $data['montant'];
                $entreprise_id = Null;
            }
            //Données pour eau
            if($service->slug == "somagep"){
                Somagep::create($data);
                $montant = $data['montant'];
                $entreprise_id = Null;
            }

            //Données pour le service carte d'identité
            if($service->slug == "carte-national-didentite"){
                CarteIdentite::create($data);
                $montant = $service->prix;
                $entreprise_id = Null;
            }

            //Données pour le service passport
            if($service->slug == "passport"){
                Passport::create($data);
                $montant = $service->prix;
                $entreprise_id = Null;
               
            } 
            
            //Deplacer les fichiers du dossier temporaire
            //Fichiers pour passport
            if(array_key_exists('identitePath', $data)){
                $fileIdentite = new File;
                $identiteName = $data['identiteName'];
                $source = $data['identitePath'];
                $destination = "/uploads/documents/identite/".Auth::user()->id."/".$identiteName;
                Storage::disk('public')->move($source, $destination);
                $fileIdentite->libelle = $identiteName;
                $fileIdentite->file_path = '/storage' . $destination;
                $fileIdentite->type = "identite";
                $fileIdentite->user_id = Auth::user()->id;
                $fileIdentite->requete_id = $requete->id;
                
                $fileIdentite->save();
            }
            if(array_key_exists('photoIdentitePath', $data)){
                $filePhotoIdentite = new File;
                $photoIdentiteName = $data['photoIdentiteName'];
                $source = $data['photoIdentitePath'];
                $destination = "/uploads/documents/photo_identite/".Auth::user()->id."/".$photoIdentiteName;
                Storage::disk('public')->move($source, $destination);
                $filePhotoIdentite->libelle = $photoIdentiteName;
                $filePhotoIdentite->file_path = '/storage' . $destination;
                $filePhotoIdentite->user_id = Auth::user()->id;
                $filePhotoIdentite->type = "photo-identite";
                $filePhotoIdentite->requete_id = $requete->id;
                
                $filePhotoIdentite->save();
            }
            if(array_key_exists('identiteTuteurPath', $data)){
                $fileIdentiteTuteur = new File;
                $identiteTuteurName = $data['identiteTuteurName'];
                $source = $data['identiteTuteurPath'];
                $destination = "/uploads/documents/identite_tuteur/".Auth::user()->id."/".$identiteTuteurName;
                Storage::disk('public')->move($source, $destination);
                $fileIdentiteTuteur->libelle = $identiteTuteurName;
                $fileIdentiteTuteur->file_path = '/storage' . $destination;
                $fileIdentiteTuteur->user_id = Auth::user()->id;
                $fileIdentiteTuteur->type = "identite-tuteur";
                $fileIdentiteTuteur->requete_id = $requete->id;
                
                $fileIdentiteTuteur->save();
            }
            if(array_key_exists('autorisationParentalePath', $data)){
                $fileAutorisation = new File;
                $autorisationParentaleName = $data['autorisationParentaleName'];
                $source = $data['autorisationParentalePath'];
                $destination = "/uploads/documents/autorisation_parentale/".Auth::user()->id."/".$autorisationParentaleName;
                Storage::disk('public')->move($source, $destination);
                $fileAutorisation->libelle = $autorisationParentaleName;
                $fileAutorisation->file_path = '/storage' . $destination;
                $fileAutorisation->user_id = Auth::user()->id;
                $fileAutorisation->type = "autorisation-parentale";
                $fileAutorisation->requete_id = $requete->id;
                
                $fileAutorisation->save();
            }
            if(array_key_exists('patentePath', $data)){
                $filePatente = new File;
                $patenteName = $data['patenteName'];
                $source = $data['patentePath'];
                $destination = "/uploads/documents/photo_identite/".Auth::user()->id."/".$patenteName;
                Storage::disk('public')->move($source, $destination);
                $filePatente->libelle = $patenteName;
                $filePatente->file_path = '/storage' . $destination;
                $filePatente->user_id = Auth::user()->id;
                $filePatente->type = "patente";
                $filePatente->requete_id = $requete->id;
                
                $filePatente->save();
            }

            //Fichier pour vignette
            if(array_key_exists('justificatifVignettePath', $data)){
                $fileJustificatifVignette = new File;
                $justificatifVignetteName = $data['justificatifVignetteName'];
                $source = $data['justificatifVignettePath'];
                $destination = "/uploads/documents/justificatif_vignette/".Auth::user()->id."/".$justificatifVignetteName;
                Storage::disk('public')->move($source, $destination);
                $fileJustificatifVignette->libelle = $justificatifVignetteName;
                $fileJustificatifVignette->file_path = '/storage' . $destination;
                $fileJustificatifVignette->user_id = Auth::user()->id;
                $fileJustificatifVignette->type = "justificatif-vignette";
                $fileJustificatifVignette->requete_id = $requete->id;
                
                $fileJustificatifVignette->save();
            }

        //Generation de notification
        if($service->type == "demande") {
            $description = Auth::user()->prenom." ".Auth::user()->nom." (".Auth::user()->email.") a fait une demande de ".$service->libelle;
        } elseif ($service->type == "paiement") {
            $description = Auth::user()->prenom." ".Auth::user()->nom." (".Auth::user()->email.") a fait effectué le paiement de ".$service->libelle;
        } else {
            $description = $service->libelle;
        }

        $slug_notification = 'notification_'.Auth::user()->id.'_'.time();
        $slug_paiement = 'paiement_'.Auth::user()->id.'_'.time();
        if ($requete) {
            Notification::create([
                'vue' => false,
                'slug' => $slug_notification,
                'description' => $description,
                'destinateur' => 'structure',
                'requete_id' => $requete->id,
                'structure_id' => $structure->id,
                'user_id' => Auth::user()->id,
            ]);

            Paiement::create([
                'slug' => $slug_paiement,
                'structure_id' => $structure->id,
                'service_id' => $service->id,
                'usager_id' => Auth::user()->id,
                'entreprise_id' => $entreprise_id,
                'requete_id' => $requete->id,
                'montant' => $montant,
            ]);
            
            //Envoie de mail
            $service = $requete->service()->associate($requete->service_id)->service;
            if($service->type == "demande") {
                $description = "Votre demande de $service->libelle a bien été soumis, vous aurez un retour dans $service->duree";
                $subject = "Demande";
            } elseif ($service->type == "paiement") {
                $description = "Votre paiement de $service->libelle a bien été effectuée";
                $subject = "Paiement";
            } else {
                $description = $service->libelle;
                $subject = "";
            }
            $data = [
                'email' => Auth::user()->email,
                'nom' => Auth::user()->nom,
                'prenom' => Auth::user()->prenom,
                'subject' => $subject,
            ];
            Mail::send('emails.demande', ['user' => Auth::user(), 'description' => $description], function ($message) use($data) {
                $message->from('info@gc-pay.com', 'GC PAY');
                $message->sender('info@gc-pay.com', 'GC PAY');
                $message->to($data['email'], $data['nom']." ".$data['prenom']);
                $message->replyTo('info@gc-pay.com', 'GC PAY');
                $message->subject($data['subject']);
            });
        }
    }
}
