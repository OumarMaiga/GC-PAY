<x-app-layout>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">

  <title> - jsFiddle demo</title>
   
  <script type='text/javascript' src='http://code.jquery.com/jquery-1.9.1.js'></script>
   
   
   
  <style type='text/css'> 
.image-ronde{
  width : 200px; height : 100px;
  border: none;
  -moz-border-radius : 75px;
  -webkit-border-radius : 75px;
  border-radius : 75px;
  margin-bottom:30px;
}
.centre
{
    
     margin-left:400px;
     width: 100px; 


}
  </style>
   
 
 
<script type='text/javascript'>//<![CDATA[
$(window).load(function(){
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
             
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
             
            reader.readAsDataURL(input.files[0]);
        }
    }
     
    $("#imgInp").change(function(){
        readURL(this);
    });
});//]]> 
 
</script>
 
 
</head>
<body>
<div class="centre"> 
<form id="form1" runat="server">
        <input type='file' id="imgInp" />
        <img id="blah" src="#" alt="" class="image-ronde"/>
    </form>
</div>
</body>
</html>


    <div class="container">
        <div class="row">
            <div class="col-md-4">

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form  method="POST" action="{{ route('update', Auth::user()->email) }}">
                @csrf
                @method('PUT')
                <!--  Nom -->
               
                <div class="form-group row">
                
                <label for="nom" class="col-sm-2 col-form-label label-size">Nom</label>
                <div class="col-sm-10">

                        <input id="nom" class="input-custom2" type="text" name="nom" :value="$user()->nom" placeholder="Nom" required autofocus />
                    </div>
                </div>

                    <!--  Prenom -->

                    <div class="form-group row">
                    <label for="prenom" class="col-sm-2 col-form-label label-size">Prénom </label>
                    <div class="col-sm-10">
                        <input id="prenom" class="input-custom" type="text" name="prenom" :value="$user()->prenom" placeholder="Prenom" required/>
                    </div>
                    </div> 

                <!--  Email Address -->
                
                    <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label label-size">Email</label>
                    <div class="col-sm-10">
                        <input id="email" class="input-custom" type="email" name="email" :value="$user-()>email" placeholder="Email" required />
                    </div>
                    </div> 

                    <!-- Phone number -->
                    
                    <div class="form-group mt-4 row">
                    <label for="telephone" class="col-sm-2 col-form-label label-size">Téléphone</label>
                    <div class="col-sm-10">
                        <input  type="tel" id="telephone"
                        class="input-custom" 
                        placeholder="Téléphone" name="telephone" :value="$user()->telephone" required />
                    </div>
                    </div> 
                    
                    <div class="mt-4">
                        <button type="submit" class=" btn-custom2">
                            {{ __('MODIFIER') }}
                        </button>
                    </div>

                    <div classe="mt-4  ">
                    
                    <a href="{{ url('/dashboard') }}"> <input type="button" value="ANNULER"class=" btn-custom2 change-color"></a>

                    </div>
                   
                    
                </form>
            </div>
        </div>
    </div>
 
</x-app-layout>