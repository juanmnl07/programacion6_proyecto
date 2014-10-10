<!DOCUMENT HTML>
<html>
<head>
	<!-- META -->
	{% block head %}
	<meta charset="UTF-8">
	<!-- SCRIPTS -->
	<?php if(file_exists('scripts.html')): ?>
		<?php print_r(file_get_contents('scripts.html')); ?>
	<?php endif; ?>
	<!-- STYLE -->
	<?php if(file_exists('styles.html')): ?>
		<?php print_r(file_get_contents('styles.html')); ?>
	<?php endif; ?>
	<title>{% block title %}{% endblock %}</title>
	{% block head %}
</head>
<body>
	<?php if(file_exists('header.php')): ?>
		<?php print_r(file_get_contents('header.php')); ?>
	<?php endif; ?>
	<?php if(file_exists('contenido.php')): ?>
		<?php print_r(file_get_contents('contenido.php')); ?>
	<?php endif; ?>
	{{ name }}
	<?php if(file_exists('footer.php')): ?>
		<?php print_r(file_get_contents('footer.php')); ?>
	<?php endif; ?>
</body>
</html>