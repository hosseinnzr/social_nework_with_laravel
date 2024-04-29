<!doctype html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Webestica.com">
	<meta name="description" content="Bootstrap 5 based Social Media Network and Community Theme">

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="assets/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/dropzone/dist/dropzone.css" />
  <link rel="stylesheet" type="text/css" href="assets/vendor/glightbox-master/dist/css/glightbox.min.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/choices.js/public/assets/styles/choices.min.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/flatpickr/dist/flatpickr.min.css">

	<!-- Theme CSS -->
	<link id="style-switch" rel="stylesheet" type="text/css" href="assets/css/style.css">
  
  </head>
  <body>
    @include('include.header')
    @yield('content')
  </body>
</html>