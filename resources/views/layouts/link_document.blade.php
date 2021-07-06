
    <?php
        $documents = collect([]);
        $identite = App\Models\File::where('type', 'identite')->where('requete_id', $requete->id)->first();
        if ($identite) {
            $identite_path = $identite->file_path;
            $documents->put('Identité', $identite_path);
        }
        $photoIdentite = App\Models\File::where('type', 'photo-identite')->where('requete_id', $requete->id)->first();
        if ($photoIdentite) {
            $photoIdentite_path = $photoIdentite->file_path;
            $documents->put('Photo d\'identité', $photoIdentite_path);
        }
        $identiteTuteur = App\Models\File::where('type', 'identite-tuteur')->where('requete_id', $requete->id)->first();
        if ($identiteTuteur) {
            $identiteTuteur_path = $identiteTuteur->file_path;
            $documents->put('Identité du tuteur', $identiteTuteur_path);
        }
        $autorisationParentale = App\Models\File::where('type', 'autorisation-parentale')->where('requete_id', $requete->id)->first();
        if ($autorisationParentale) {
            $autorisationParentale_path = $autorisationParentale->file_path;
            $documents->put('Autorisation parentale', $autorisationParentale_path);
        }
        $patente = App\Models\File::where('type', 'patente')->where('requete_id', $requete->id)->first();
        if ($patente) {
            $patente_path = $patente->file_path;
            $documents->put('Patente', $patente_path);
        }
        $justificatifVignette = App\Models\File::where('type', 'justificatif-vignette')->where('requete_id', $requete->id)->first();
        if ($justificatifVignette) {
            $justificatifVignette_path = $justificatifVignette->file_path;
            $documents->put('Certificat d\'achat ou ancienne vignette', $justificatifVignette_path);
        }

        $documents->map(function ($item, $key) {
    ?>
        <a target="_blank" href="{{ $item }}">{{ $key }},</a>

        <?php }); ?>