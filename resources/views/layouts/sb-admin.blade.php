<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>{{ config('app.name') }} - @yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.min.css" integrity="sha512-RIG2KoKRs0GLkvl0goS0cdkTgQ3mOiF/jupXuBsMvyB3ITFpTJLnBu59eE+0R39bxDQKo2dsatA5CwHeIKVFcw==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

	@stack('css')
</head>
<body>
	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-file"></i>
				</div>
				<div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			@yield('sidebar')

			<div class="text-center d-none d-md-inline">
	            <button class="rounded-circle border-0" id="sidebarToggle"></button>
	        </div>
		</ul>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<!-- Nav Item - User Information -->
						{{-- <li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-lg-inline text-gray-600 small">
									{{-- {{ auth()->user()->name }} --}}
								</span>
							</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								{{-- <a class="dropdown-item" href="{{ route('admin.setting.index') }}">
									<i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
									Setting
								</a> --}}
								{{-- <a class="dropdown-item" href="{{ route('logout') }}">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a> --}}
							</div>
						{{-- </li> --}}

					</ul>

				</nav>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">
							@yield('content_header')
						</h1>
					</div>

					@yield('content')
				</div>
				<!-- Footer -->
				<!-- <footer class="sticky-footer bg-white">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>Copyright &copy; TesyarRAz 2021</span>
						</div>
					</div>
				</footer> -->
				<!-- End of Footer -->

			</div>
			<!-- End of Content Wrapper -->

		</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/js/sb-admin-2.min.js" integrity="sha512-COtY6/Rv4GyQdDShOyay/0YI4ePJ7QeKwtJIOCQ3RNE32WOPI4IYxq6Iz5JWcQpnylt/20KBvqEROZTEj/Hopw==" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="{{ asset('js/image-preview.js') }}"></script>

	<script type="text/javascript">
		@if (session()->has('status'))
			Swal.fire("Informasi", '{{ session('status') }}', 'info');
		@endif
		@if ($errors->any())
			Swal.fire("Error", '{{ $errors->first() }}', 'error');
		@endif
	</script>

	{{-- Disable Sidebar Auto Toggle --}}
	<script type="text/javascript">
		$(function() {
			$(window).off("resize");
		})
	</script>

	{{-- Toggle sidebar jika ukurannya kurang dari 992 --}}
	<script type="text/javascript">
		$(function() {
			if ($(document).width() > 992) {
				$(".sidebar").removeClass('toggled');
			}
		});
	</script>

	@stack('js')
</body>
</html>