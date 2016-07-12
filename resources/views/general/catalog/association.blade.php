<div class="container-fluid padding_vertical_30" style="background-image: url(/img/members.jpg);">
	<div class="container">
		<div class="title title_white text_center">
			КОМПАНИИ-ЧЛЕНЫ АССОЦИАЦИИ КРОВЕЛЬЩИКОВ УКРАИНЫ
		</div>
		<div class="slider company-cart-slider slider_white offset_vertical_30">
			<ul class="slides">
				@foreach ($association as $company)
					<li>
						<div class="company-cart company-cart_white company-cart_big">
							<a href="{{route('catalog.show',$company)}}"><img src="/resize/85/85/{{ $company->logo }}" alt="" class="company-cart__logo"></a>
							<a href="{{route('catalog.show', $company)}}" class="company-cart__name">{{ $company->name }}</a>
							<div class="company-cart__description">{{ str_limit($company->entry,150) }}</div>
							<div class="container__row company-cart__bottom">
								<div class="container__col-8">
									<div class="company-cart__address">{{ $company->printAddress() }}</div>
									@if($company->site)
									<a href="http://{{$company->site}}" class="company-cart__post-date">
										Сайт компании:
										{{$company->site}}
									</a>
									@endif
								</div>
								<div class="container__col-4">
									{{ $company->phone }}
								</div>
							</div>
							<img src="/img/user-menu-1.png" alt="" class="company-cart__member-label company-cart__right-bottom">
						</div>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>