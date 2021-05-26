<x-app-layout>


    <div class="container">
        <div class="row">
            <div class="col-md-4">
             <!--  avatar -->
            <div class="form-group row">
                <div class="centre2"> 
           
            <img src="/storage/profil_pictures/picture_user_{{$user->id}}.jpg" class="avatar"/>
           
            </div>
            </div>
            <div class="form-group row">
            <a class="nav-link" href="{{ url('/{email}/profil') }}">
                        <img src=" https://ora.ox.ac.uk/assets/resources/report-f75cb5cd55c2a662e6d11574d303c1fe0d63d561193377a8e3d7316b945b9ff6.svg" class="img-social-media2" alt=""/>
           
            <a class="link-profil" href="{{ url('/{email}/profil') }}"> A PROPOS</a>
            </div>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <!--  Nom -->
              
              
               
                <div class="form-group row">
                
                <label for="nom" class="col-sm-2 col-form-label label-size">Nom</label>
                <div class="col-sm-10">

                        <input id="nom" class=" input-white" readonly="readonly" type="text" name="nom" value="{{ $user->nom }}" placeholder="Nom" required/>
                    </div>
                </div>

                    <!--  Prenom -->

                    <div class="form-group row">
                    <label for="prenom" class="col-sm-2 col-form-label label-size">Prénom </label>
                    <div class="col-sm-10">
                        <input id="prenom" class="input-white" type="text" readonly="readonly" name="prenom" value="{{ $user->prenom }}" placeholder="Prenom" required/>
                    </div>
                    </div> 

                <!--  Email Address -->
                
                    <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label label-size">Email</label>
                    <div class="col-sm-10">
                        <input id="email" class="input-white" type="email"  readonly="readonly" name="email" value="{{ $user->email }}" placeholder="Email" required />
                    </div>
                    </div> 

                    <!-- Phone number -->
                    
                    <div class="form-group mt-4 row">
                    <label for="telephone" class="col-sm-2 col-form-label label-size">Téléphone</label>
                    <div class="col-sm-10">
                        <input  type="tel" id="telephone"
                        class="input-white" 
                        placeholder="Téléphone" name="telephone" readonly="readonly" value="{{ $user->telephone }}" required />
                    </div>
                    </div> 
                    
                    
               
            </div>
        </div>
    </div>
 
</x-app-layout>