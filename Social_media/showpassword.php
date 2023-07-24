<!-- show password -->
<script>

	$(document).ready(function() {

		$(".password-toggle-icon").click(function() {

			var passwordField = $("#password");
			var fieldType = passwordField.attr("type");

			if (fieldType === "password") {

				passwordField.attr("type", "text");
				$(this).find("i").removeClass("far fa-eye").addClass("far fa-eye-slash");
			} 
            else {
				passwordField.attr("type", "password");
				$(this).find("i").removeClass("far fa-eye-slash").addClass("far fa-eye");
			}

		});

	});
</script>