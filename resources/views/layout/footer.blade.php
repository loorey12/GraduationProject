
<footer>
  <script src="{{ URL::asset('js/app.js')}}"></script>
        <div id="desktop_footer" class="container pt-5">
            <div class="row">
                <div class="col-sm-3 mt-2 footer-text">
                    <p> HQM - One of the best Free online movies site, here you can watch
                        movies online in high quality for free
                        movies online in high quality for free
                    </p>
                </div>
                <div class="col-sm-3 mt-2 footer-text">
                    <p> Free movies online, here you can watch
                        movies online in high quality for free
                        without annoying  advertisement.
                    </p>
                </div>
                <div class="col-2 mt-2">
                    <h4 class="btn btn-danger text-light">HELP</h4>
                    <p style="cursor:pointer" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Request</p>
                    <p style="cursor:pointer" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Report</p>

                </div>
                <div class="col-2 mt-2">
                    <h4 class="btn btn-light ">COUNTRY</h4>
                    <a class="nav-link text-secondary py-0" href="/search?search=nepal"><p>Nepal</p></a>
                    <a class="nav-link text-secondary py-0" href="/search?search=vietnam"><p>Vietnam</p></a>
                    <a class="nav-link text-secondary py-0" href="/search?search=korea"><p>Korea</p></a>
                    <a class="nav-link text-secondary py-0" href="/search?search=japan"><p>Japan</p></a>

                </div>
                <div class="col-2 mt-2">
                    <h4 class="btn btn-light ">MOVIES</h4>
                    <a class="nav-link text-secondary py-0" href="/index?genre=28&&name=Action"><p>Action</p></a>
                    <a class="nav-link text-secondary py-0" href="/index?genre=53&&name=Thriller"><p>Thriller</p></a>
                    <a class="nav-link text-secondary py-0" href="/index?genre=10770&&name=Romance"><p>Romance</p></a>
                    <a class="nav-link text-secondary py-0" href="/index?genre=878&&name=Sci-Fi"><p>Sci-Fi</p></a>
                </div>
            </div>
        </div>
        <div id='mobile_footer' class="container ">
            <div class="row text-light ">
                <div class="col-4 mt-5 text-center">
                    <h4 class="btn btn-danger">HELP</h4>
                    <p style="cursor:pointer" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Request</p>
                    <p style="cursor:pointer" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Report</p>

                </div>
                <div class="col-4 mt-5 text-center">
                    <h4 class="btn btn-light">COUNTRY</h4>
                    <a class="nav-link text-secondary py-0" href="/search?search=nepal"><p>Nepal</p></a>
                    <a class="nav-link text-secondary py-0" href="/search?search=vietnam"><p>Vietnam</p></a>
                    <a class="nav-link text-secondary py-0" href="/search?search=korea"><p>Korea</p></a>
                    <a class="nav-link text-secondary py-0" href="/search?search=japan"><p>Japan</p></a>

                </div>
                <div class="col-4 mt-5 text-center">
                    <h4 class="btn btn-light">MOVIES</h4>
                    <a class="nav-link text-secondary py-0" href="/index?genre=28&&name=Action"><p>Action</p></a>
                    <a class="nav-link text-secondary py-0" href="/index?genre=53&&name=Thriller"><p>Thriller</p></a>
                    <a class="nav-link text-secondary py-0" href="/index?genre=10770&&name=Romance"><p>Romance</p></a>
                    <a class="nav-link text-secondary py-0" href="/index?genre=878&&name=Sci-Fi"><p>Sci-Fi</p></a>
                </div>
            </div>
        </div>
</footer>
<!-- Report and Request Form -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="exampleModalLabel"><i class="fas fa-share-alt-square text-danger"></i> Report/Request Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/message" method="post">
            @csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label font-weight-bold btn btn-outline-dark btn-sm">Subject</label>
            <input type="text" name="subject" class="form-control mt-2" id="recipient-name " placeholder="Your Subject" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label font-weight-bold btn btn-outline-dark btn-sm">Message:</label>
            <textarea class="form-control mt-2" name="message" id="message-text" placeholder="Request MOVIES, DRAMAS or report text" required></textarea>
          </div>
        <button type="submit" class="btn btn-outline-secondary"  ><i class="fas fa-paper-plane text-primary"></i> Send</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="copyright bg-dark">
    <p class="text-light pt-2">&copy; Copy right 2020 HQM movies highquality-movies.com</p>
</div>

</body>

</html>
