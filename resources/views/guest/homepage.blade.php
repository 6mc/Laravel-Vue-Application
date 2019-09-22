@extends('layouts.main')

@section('content')

			<div role="main" class="main">

				<div class="container">
					<div class="row">
						<div class="col-md-12 center">
							<h2 class="mt-xl mb-none">Seçili Bölgedeki Aktif  Firmalar</h2>
							<div class="divider divider-primary divider-small divider-small-center mb-xl">
								<hr>
							</div>
						</div>
					</div>
					<div class="row mt-xl">
						<div class="col-md-6">

							<span class="thumb-info thumb-info-side-image thumb-info-no-zoom mb-xl">
								<span class="thumb-info-side-image-wrapper p-none hidden-xs">
									<a title="" href="./firma">
										<img src="dosya/demo-img/blog-law-firm-1.jpg" class="img-responsive" alt="" style="width: 195px;">
									</a>
								</span>
								<span class="thumb-info-caption">
									<span class="thumb-info-caption-text">
										<h2 class="mb-md mt-xs"><a title="" class="text-dark" href="./firma">Firma Bir</a></h2>
										<span class="post-meta">
											<span>January 10, 2016 | <a href="#">John Doe</a></span>
										</span>
										<p class="font-size-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu pulvinar magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
										<a class="mt-md" href="./firma">Read More <i class="fa fa-long-arrow-right"></i></a>
									</span>
								</span>
							</span>

						</div>
						<div class="col-md-6">

							<span class="thumb-info thumb-info-side-image thumb-info-no-zoom mb-xl">
								<span class="thumb-info-side-image-wrapper p-none hidden-xs">
									<a title="" href="./firma">
										<img src="dosya/demo-img/blog-law-firm-1.jpg" class="img-responsive" alt="" style="width: 195px;">
									</a>
								</span>
								<span class="thumb-info-caption">
									<span class="thumb-info-caption-text">
										<h2 class="mb-md mt-xs"><a title="" class="text-dark" href="./firma">sanane</a></h2>
										<span class="post-meta">
											<span>January 10, 2016 | <a href="#">John Doe</a></span>
										</span>
										<p class="font-size-md">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eu pulvinar magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
										<a class="mt-md" href="./firma">Read More <i class="fa fa-long-arrow-right"></i></a>
									</span>
								</span>
							</span>

						</div>
					</div>
				</div>

			</div>
@endsection('content')