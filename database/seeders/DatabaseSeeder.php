<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use \App\Models\User;
use \App\Models\Structure;
use \App\Models\Rubrique;
use \App\Models\Service;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //Création de l'admin systeme
        User::create([
            'email' => 'admin@gcpay.com',
            'telephone' => '+223 20 55 36 14',
            'password' => Hash::make('password123'),
            'type' => 'admin-systeme',
            'etat' => 1,
        ])->save();
        
        //Création des structures
        $dgi = Structure::create([
            'libelle' => 'Direction Général des impôts',
            'slug' => 'direction-general-des-impots',
            'type' => 'impot',
            'adresse' => 'Bamako, commune IV, Hamdallaye ACI 2000',
            'telephone' => '20 22 22 20',
            'user_id' => 1,
        ]);
        $mairie = Structure::create([
            'libelle' => 'Mairie du district',
            'slug' => 'mairie-du-district',
            'type' => 'mairie',
            'adresse' => 'Bamako, commune III, Quartier du fleuve',
            'telephone' => '20 10 10 10',
            'user_id' => 1,
        ]);
        $police = Structure::create([
            'libelle' => ' Direction de la Police des Frontière',
            'slug' => ' direction-de-la-police-des-frontiere',
            'type' => 'police',
            'adresse' => 'Bamako, commune IV, Hamdallaye ACI 2000',
            'telephone' => '+223 20 21 21 21',
            'user_id' => 1,
        ]);
        $energie = Structure::create([
            'libelle' => ' Energie du Mali',
            'slug' => ' energie-du-mali',
            'type' => 'autre',
            'adresse' => 'Bamako, commune III, Quartier du fleuve, Square Patrice Lumumba',
            'telephone' => '+223 20 22 30 20',
            'user_id' => 1,
        ]);
        $somagep = Structure::create([
            'libelle' => ' SOMAGEP',
            'slug' => ' somagep',
            'type' => 'autre',
            'adresse' => 'Bamako, commune IV,  Djicoroni Troukabougou ',
            'telephone' => '20 70 41 00',
            'user_id' => 1,
        ]);
        
        //Création des rubriques
        Rubrique::create([
            'libelle' => 'Impôts et Taxes',
            'slug' => 'impots-et-taxes',
            'admin_systeme_id' => 1,
            'etat' => 1,
        ])->save();
        Rubrique::create([
            'libelle' => 'Automobile',
            'slug' => 'automobile',
            'admin_systeme_id' => 1,
            'etat' => 1,
        ])->save();
        Rubrique::create([
            'libelle' => 'Identité',
            'slug' => 'identite',
            'admin_systeme_id' => 1,
            'etat' => 1,
        ])->save();
        Rubrique::create([
            'libelle' => 'Eau et electricité',
            'slug' => 'eau-et-electricité',
            'admin_systeme_id' => 1,
            'etat' => 1,
        ])->save();
        
        //Création des services
        $its = Service::create([
            'libelle' => 'Impôt sur le traitement des salaires',
            'slug' => 'impot-sur-le-traitement-des-salaires',
            'description' => 'L’impôt sur les traitements et salaires est 
                            applicable à toutes les sommes payées par un 
                            employeur privé ou public y compris les pourboires. 
                            Il est fixé en tenant compte de la situation familiale 
                            et de certaines situations personnelles.',
            'duree' => 'Immediate',
            'prix' => 'Variable',
            'type' => 'paiement',
            'rubrique_id' => 1,
            'admin_systeme_id' => 1,
            'etat' => 1,
        ]);
        $tl = Service::create([
            'libelle' => 'Taxe logement',
            'slug' => 'taxe-logement',
            'description' => 'La  taxe logement égale à 1 % de la masse salariale 
                            brute supportée par les employeurs publics et privés. 
                            Cette taxe est versée mensuellement.',
            'duree' => 'Immediate',
            'prix' => 'Variable',
            'type' => 'paiement',
            'rubrique_id' => 1,
            'admin_systeme_id' => 1,
            'etat' => 1,
        ]);
        $tf = Service::create([
            'libelle' => 'Taxe foncière',
            'slug' => 'taxe-fonciere',
            'description' => 'Le taux de la taxe foncière est fixé à 3 pourcent 
                        La taxe foncière est per¸cue au profit du budget des 
                        collectivités territoriales.',
            'duree' => 'Immediate',
            'prix' => 'Variable',
            'type' => 'paiement',
            'rubrique_id' => 1,
            'admin_systeme_id' => 1,
            'etat' => 1,
        ]);
        $dgi->services()->attach([1,2,3]);
        $vignette1 = Service::create([
            'libelle' => 'Vignette pour plus de 125 cm<sup>3</sup> de cylindrée',
            'slug' => 'vignette-pour-plus-de-125-cmsup3sup-de-cylindree',
            'description' => '<p>Tout propri&eacute;taire d\'automobile ou d\'engins &agrave; deux ou trois roues est assujetti &agrave; la taxe sur v&eacute;hicules automobile.</p>
            <h2><strong>Documents &agrave; fournir:</strong></h2>
            <ul style="list-style-type: square;">
            <li>Certificat d\'achat ou ancienne vignette</li>
            </ul>',
            'duree' => 'Immediate',
            'prix' => '12000',
            'type' => 'demande',
            'rubrique_id' => 2,
            'admin_systeme_id' => 1,
            'etat' => 1,
        ]);
        $vignette2 = Service::create([
            'libelle' => 'Vignette pour 51cm<sup>3</sup> à 125 cm<sup>3</sup> de cylindrée',
            'slug' => 'vignette-pour-51cmsup3sup-a-125-cmsup3sup-de-cylindree',
            'description' => '<p>Tout propri&eacute;taire d\'automobile ou d\'engins &agrave; deux ou trois roues est assujetti &agrave; la taxe sur v&eacute;hicules automobile.</p>
            <h2><strong>Documents &agrave; fournir:</strong></h2>
            <ul style="list-style-type: square;">
            <li>Certificat d\'achat ou ancienne vignette</li>
            </ul>',
            'duree' => 'Immediate',
            'prix' => '7000',
            'type' => 'demande',
            'rubrique_id' => 2,
            'admin_systeme_id' => 1,
            'etat' => 1,
        ]);
        $vignette3 = Service::create([
            'libelle' => 'Vignette pour moins de 50cm<sup>3</sup> de cylindrée',
            'slug' => 'vignette-pour-moins-de-50cmsup3sup-de-cylindree',
            'description' => '<p>Tout propri&eacute;taire d\'automobile ou d\'engins &agrave; deux ou trois roues est assujetti &agrave; la taxe sur v&eacute;hicules automobile.</p>
            <h2><strong>Documents &agrave; fournir:</strong></h2>
            <ul style="list-style-type: square;">
            <li>Certificat d\'achat ou ancienne vignette</li>
            </ul>',
            'duree' => 'Immediate',
            'prix' => '6000',
            'type' => 'demande',
            'rubrique_id' => 2,
            'admin_systeme_id' => 1,
            'etat' => 1,
        ]);
        $mairie->services()->attach([4,5,6]);

        $passport = Service::create([
            'libelle' => 'Passport',
            'slug' => 'passport',
            'description' => '<p>Un passeport le document de circulation d&eacute;livr&eacute; par le gouvernement &agrave; ses citoyens, pi&egrave;ce d\'identit&eacute; permettant &agrave; son porteur de voyager &agrave; l\'​&eacute;tranger.</p>
            <h2><strong>Document &agrave; fournir:</strong></h2>
            <ul style="list-style-type: square;">
            <li>Justificatif d\'identité: Carte nationale d&rsquo;Identit&eacute; en cours de validit&eacute;, ou la copie de l&rsquo;extrait d&rsquo;acte de naissance (volet III) ou encore l&rsquo;ancien passeport.</li>
            <li>2 photos d&rsquo;identit&eacute; en couleurs.</li>
            <li>Pour les enfants mineurs : 2 photos d&rsquo;identit&eacute; en couleurs, l&rsquo;autorisation parentale l&eacute;galis&eacute;e et la photocopie du passeport ou de la CI du Tuteur.</li>
            <li>Pour les op&eacute;rateurs &eacute;conomiques: la photocopie de la patente ou de la vignette synth&eacute;tique.</li>
            </ul>',
            'duree' => '2 semaines',
            'prix' => '50000',
            'type' => 'demande',
            'rubrique_id' => 3,
            'admin_systeme_id' => 1,
            'etat' => 1,
        ]);
        $carteIdentite = Service::create([
            'libelle' => 'Carte national d\'identité',
            'slug' => 'carte-national-didentite',
            'description' => '<p>La carte national d\'identité est un document officiel qui permet à une personne physique de prouver son identité.</p>
            <h2><strong>Documents à fournir:</strong></h2>
            <ul style="list-style-type: square;">
                <li>3 photos d\'identité</li>
                <li>Justificatif d\'identité: Carte d\'identité en fin de validité (ou une copie de l\'extrait d\'acte de naissance, ou le carnet de famille, ou l\'acte de mariage ou encore 2 témoins connus du quartier munis de leur pièce d\'identité; en cour de validité)</li>
                <li>Timbres fiscaux (500 + 200 francs FCFA)</li>
            </ul>',
            'duree' => '24h',
            'prix' => '1000',
            'type' => 'demande',
            'rubrique_id' => 3,
            'admin_systeme_id' => 1,
            'etat' => 1,
        ]);
        $police->services()->attach([7,8]);

        $edm = Service::create([
            'libelle' => 'Energie du Mali',
            'slug' => 'energie-du-mali',
            'description' => 'Compagnie national d\'electricité au MALI.',
            'duree' => 'Immediate',
            'prix' => 'Variable',
            'type' => 'paiement',
            'rubrique_id' => 4,
            'admin_systeme_id' => 1,
            'etat' => 1,
        ]);
        $energie->services()->attach([9]);

        $eau = Service::create([
            'libelle' => 'SOMAGEP',
            'slug' => 'somagep',
            'description' => 'Société malienne de gestion de l\'eau potable.',
            'duree' => 'Immediate',
            'prix' => 'Variable',
            'type' => 'paiement',
            'rubrique_id' => 4,
            'admin_systeme_id' => 1,
            'etat' => 1,
        ]);
        $somagep->services()->attach([10]);
    }
}
