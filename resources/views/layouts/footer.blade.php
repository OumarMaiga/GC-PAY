<footer class="foot">
  <!-- Grid container -->
  <div class="container p-4">
    <!--Grid row-->
    <div class="row justify-content-start">
      <!--Grid column-->
      @if(Auth::check())
      <div class="col-md-3 vertical">
      @else
      <div class="col-md-6 vertical">
      @endif
        <h5 class="footer-title">LIENS</h5>

        <ul class="footer-list">
          <li class="footer-item">
            <a href="{{route('home')}}" class="footer-link">Acceuil</a>
          </li>
          <li class="footer-item">
            <a href="#" class="footer-link">A propos</a>
          </li>
          <li class="footer-item">
            <a href="#" class="footer-link">Contact</a>
          </li>
        </ul>
      </div>

      @if(Auth::check())
      <div class="col-md-3 vertical">
      
        <h5 class="footer-title">NAVIGATION</h5>

        <ul class="footer-list">
          <li class="footer-item">
            <a href="{{ route('notification.list') }}" class="footer-link">Notification</a>
          </li>
          <li class="footer-item">
            <a href="{{ route('historique.list') }}" class="footer-link">Historique</a>
          </li>
          @if(Auth::user()->type=='usager')
          <li class="footer-item">
            <a href="{{route('usager.entreprise')}}" class="footer-link">Entreprise</a>
          </li>
          @endif
        </ul>
      </div>
      @endif

      <!--Grid column-->
      <div class="col-md-6">
        <div class="row">
          <div class="col">
            <h5 class="footer-title">A PROPOS</h5>

            <ul class="footer-list">
              <li class="footer-item">
                <a href="#" class="footer-link">Condition d'utilisation</a>
              </li>
              <li class="footer-item">
                <a href="#" class="footer-link">Qui sommes nous?</a>
              </li>
              <li class="footer-item">
                <a href="#" class="footer-link">Besoin d'aide?</a>
              </li>
            
            </ul>
          </div>

          <div class="col">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/26/Armoiries_Mali.png" class="ml-auto img-embleme" alt=""\>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        Tous droits réservés 2021 | fait par
    <a class="text-white" href="https://www.general-computech.com/">General Computech</a>
  </div>
  <!-- Copyright -->
</footer>
