<?php
require "db/connect.php";
?>
<?php
include("./include/header.php");
include("./include/menu.php");
include("./include/slider.php");

if (isset($_GET['quanly'])) {
	$tam = $_GET['quanly'];
} else {
	$tam = '';
}

if ($tam == 'danhmuc') {
	include("./include/danhmuc.php");
} else if ($tam == 'chitietsp') {
	include("./include/chitietsp.php");
} else if ($tam == 'giohang') {
	include("./include/giohang.php");
} else if ($tam == 'timkiem') {
	include("./include/timkiem.php");
} else if ($tam == 'xemdonhang') {
	include("./include/xemdonhang.php");
} else {
	include("./include/home.php");
}

include("./include/footer.php");

?>

<!-- jquery -->
<script src="js/jquery-2.2.3.min.js"></script>
<!-- //jquery -->

<!-- nav smooth scroll -->
<script>
	$(document).ready(function() {
		$(".dropdown").hover(
			function() {
				$('.dropdown-menu', this).stop(true, true).slideDown("fast");
				$(this).toggleClass('open');
			},
			function() {
				$('.dropdown-menu', this).stop(true, true).slideUp("fast");
				$(this).toggleClass('open');
			}
		);
	});
</script>
<!-- //nav smooth scroll -->

<!-- popup modal (for location)-->
<script src="js/jquery.magnific-popup.js"></script>
<script>
	$(document).ready(function() {
		$('.popup-with-zoom-anim').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});

	});
</script>
<!-- //popup modal (for location)-->

<!-- cart-js -->
<!-- <script src="js/minicart.js"></script> -->
<script>
	paypals.minicarts
		.render(); //use only unique class names other than paypals.minicarts.Also Replace same class name in css and minicart.min.js

	paypals.minicarts.cart.on('checkout', function(evt) {
		var items = this.items(),
			len = items.length,
			total = 0,
			i;

		// Count the number of each item in the cart
		for (i = 0; i < len; i++) {
			total += items[i].get('quantity');
		}

		if (total < 3) {
			alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
			evt.preventDefault();
		}
	});
</script>
<!-- //cart-js -->

<!-- password-script -->
<script>
	window.onload = function() {
		document.getElementById("password1").onchange = validatePassword;
		document.getElementById("password2").onchange = validatePassword;
	}

	function validatePassword() {
		var pass2 = document.getElementById("password2").value;
		var pass1 = document.getElementById("password1").value;
		if (pass1 != pass2)
			document.getElementById("password2").setCustomValidity("Passwords Don't Match");
		else
			document.getElementById("password2").setCustomValidity('');
		//empty string means no validation error
	}
</script>
<!-- //password-script -->
<!-- imagezoom -->
<script src="js/imagezoom.js"></script>
<!-- //imagezoom -->

<!-- flexslider -->
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />

<script src="js/jquery.flexslider.js"></script>
<script>
	// Can also be used with $(document).ready()
	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "slide",
			controlNav: "thumbnails"
		});
	});
</script>
<!-- //FlexSlider-->
<!-- scroll seller -->
<script src="js/scroll.js"></script>
<!-- //scroll seller -->

<!-- smoothscroll -->
<script src="js/SmoothScroll.min.js"></script>
<!-- //smoothscroll -->

<!-- start-smooth-scrolling -->
<script src="js/move-top.js"></script>
<script src="js/easing.js"></script>
<script>
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event) {
			event.preventDefault();

			$('html,body').animate({
				scrollTop: $(this.hash).offset().top
			}, 1000);
		});
	});
</script>
<!-- //end-smooth-scrolling -->

<!-- smooth-scrolling-of-move-up -->
<script>
	$(document).ready(function() {
		/*
		var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
		};
		*/
		$().UItoTop({
			easingType: 'easeOutQuart'
		});

	});
</script>
<!-- //smooth-scrolling-of-move-up -->

<!-- for bootstrap working -->
<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->
<!-- //js-files -->
</body>

</html>