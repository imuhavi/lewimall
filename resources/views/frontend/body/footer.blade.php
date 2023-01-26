<!-----------------------------
          Footer Section 
    ------------------------------->
<footer class="footer-section">
  <div class="footer-top">
    <div class="container">
      <div class="row g-5">
        <div class="col-md-4 col-7 pe-0">
          <div class="contact-info text-dark">
            <h3 class="footer-title">Contact</h3>
            <p><i class="fas fa-envelope"></i><a href="mailto:info@lewimall.com"><span class="ps-3">info@lewimall.com</span></a>
            </p>
            <p><i class="fas fa-phone"></i><span class="ps-3">+254794080887</span></p>
            <p><i class="fas fa-map-marker-alt"></i></i><span class="ps-3">Made with <i
                  class="fas fa-heart text-denger"></i> Laravel</span>
            </p>
          </div>
        </div>

        <div class="col-md-2 col-5 ps-0">
          <div class="contact-info">
            <h3 class="footer-title">Quick Link</h3>
            <ul>
              <li><a href="{{ route('home') }}">Home</a></li>
              <li><a href="{{ route('subscription') }}">Become Seller</a></li>
              <li><a href="#">Contact Us</a></li>
              <li><a href="{{ route('subscription') }}">Join Us</a></li>
              <li><a href="{{ route('login') }}">Login</a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-4 col-7">
          <div class="contact-info">
            <h3 class="footer-title">Company</h3>
            <h2 class="logo"><a href="{{ route('home') }}">lewi Mall</a></h2>
            <p class="py-3">Collecting the dots. Then connecting them. And then sharing the connections with those
              around you. This is how a creative human works. Collecting, connecting, sharing.</p>

            <a class="btn btn-outline-secondary" href="{{ route('subscription') }}">Join As Designer</a>
          </div>
        </div>

        <div class="col-md-2 col-5 ps-0">
          <div class="contact-info">
            <h3 class="footer-title">Legal</h3>
            <ul>
              <li><a href="{{ route('privacyPolicy') }}">Privacy Policy</a></li>
              <li><a href="{{ route('termsAndCondition') }}">Terms & Conditions </a></li>
            </ul>

            <p>Social Link:</p>
            <ul class="d-flex social-icon">
              <li><a href=""><i class="fab fa-twitter" target="_blank"></i></a></li>
              <li><a href="https://www.instagram.com/p/CZ0gGHloQZl/?utm_medium=copy_link" target="_blank"><i
                    class="fab fa-instagram"></i></a></li>
              <li><a href="https://wa.me/message/N7U5REXGD3ODN1" target="_blank"><i class="fab fa-whatsapp"></i></a>
              </li>
            </ul>

          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <p class="text-center">Copyright &copy;
      <script type="text/javascript"> document.write(new Date().getFullYear());</script> [lewimall.com] All
      rights reserved.
    </p>
  </div>
</footer>