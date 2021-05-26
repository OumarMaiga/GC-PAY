<x-app-layout>
    <div class="container">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form  method="POST" action="{{ route('profil.update', $user->email) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!--  avatar -->
            <div class="form-group row">
                <div class="col-12 d-flex justify-content-center"> 
                    <div class="image-container">
                        @if (photo_profil())
                            <img src="/storage/profil_pictures/{{ photo_profil() }}" class="avatar"/>
                        @else
                            <img src='/storage/profil_pictures/default.jpg'  class='avatar'/>
                        @endif
                    <?php 
                        /*$filename=$_SERVER['DOCUMENT_ROOT']."/storage/profil_pictures/picture_user_1.jpg";
                        if(file_exists($filename))
                        {
                            echo" <img src='/storage/profil_pictures/picture_user_1.jpg' class='avatar'/> ";
                        }
                        else
                        {
                            echo" <img src='/storage/profil_pictures/default.jpg' class='avatar'/> ";
                        }*/
                    ?>
                        <input type='file' id="imgInp" name="avatar" />
                    </div>
                </div>
            </div>
           
            <!--  Nom -->
            <div class="form-group row mt-4">
                <label for="nom" class="col-sm-2 col-form-label label-size">Nom</label>
                <div class="col-sm-10">
                    <input id="nom" class="input-custom" type="text" name="nom" value="{{ $user->nom }}" placeholder="Nom" required autofocus />
                </div>
            </div>
            
            <!--  Prenom -->
            <div class="form-group row mt-4">
                <label for="prenom" class="col-sm-2 col-form-label label-size">Prénom </label>
                <div class="col-sm-10">
                    <input id="prenom" class="input-custom" type="text" name="prenom" value="{{ $user->prenom }}" placeholder="Prenom" required/>
                </div>
            </div> 

            <!--  Email Address -->
            <div class="form-group row mt-4">
                <label for="email" class="col-sm-2 col-form-label label-size">Email</label>
                <div class="col-sm-10">
                    <input id="email" class="input-custom" type="email" name="email" value="{{ $user->email }}" placeholder="Email" required />
                </div>
            </div> 

            <!-- Phone number -->
            <div class="form-group mt-4 row">
                <label for="telephone" class="col-sm-2 col-form-label label-size">Téléphone</label>
                <div class="col-sm-10">
                    <input  type="tel" id="telephone"
                    class="input-custom" 
                    placeholder="Téléphone" name="telephone" value="{{ $user->telephone }}" required />
                </div>
            </div> 
                
            <div class="form-group row mt-4">
                <div class="offset-sm-2">
                    <button type="submit" class="btn btn-custom">
                        {{ __('MODIFIER') }}
                    </button>
                </div>
                &nbsp;&nbsp;&nbsp;
                <div classe="">
                    <a href="{{ route('profil', $user->email) }}"> <input type="button" value="ANNULER"class="btn btn-custom-secondary"></a>
                </div>
        </form>
    </div>
 
</x-app-layout>
