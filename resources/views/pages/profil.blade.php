<x-app-layout>
    <div class="container">
        
        <!--  avatar -->
        <div class="col-12 d-flex justify-content-center"> 
            <div class="image-container">
                @if (photo_profil())
                    <img src="/storage/profil_pictures/{{ photo_profil() }}" class="avatar"/>
                @else
                    <img src='/storage/profil_pictures/default.jpg'  class='avatar'/>
                @endif
            </div>
        </div>

        <div class="col-12 mb-5">
            <h4 class="profil-title">
                A PROPOS
                <a class="ml-5" href="{{ route('profil.edit', Auth::user()->email) }}">
                    <span class="fas fa-user-edit icon-edit"></span>
                </a>
            </h4>
        </div>

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
</x-app-layout>