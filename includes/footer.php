    <footer class="page-footer">
      <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">TicketHub</h5>
                <p class="grey-text text-lighten-4">Descriptive text here!</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Site Map</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="movies.php">Movies</a></li>
                  <li><a class="grey-text text-lighten-3" href="showtimes.php">Showtimes</a></li>
                  <li><a class="grey-text text-lighten-3" href="about.php">About</a></li>
                </ul>
                <ul class="footer-left">
                  <li><a class="grey-text text-lighten-3" href="account.php">My Account</a></li>
                  <li><a class="grey-text text-lighten-3" href="signup.php">Sign Up</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2016 Harrison Lingren
            <a class="grey-text text-lighten-4 right" href="http://harrison.lingren.co">harrison.lingren.co</a>
            </div>
          </div>
    </footer>
    <script>
      $(document).ready(function(){
        $('.collapsible').collapsible();
        $('.button-collapse').sideNav();
        $('.modal').modal();
        $('ul.tabs').tabs();
        $('li.tab').first().addClass('active');
        $('select').material_select();
      });
    </script>
    <?php include('analytics.php'); ?>
  </body>
</html>
