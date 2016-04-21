<div class="container-fluid padding_vertical_30" style="background-image: url(/img/members.jpg);">
	<div class="container">
		<div class="title title_white text_center">
			КОМПАНИИ-ЧЛЕНЫ АССОЦИАЦИИ КРОВЕЛЬЩИКОВ УКРАИНЫ
		</div>
		<div class="slider flexslider company-cart-slider slider_white offset_vertical_30">
			<ul class="slides">
				@foreach ($association as $company)
					<li>
						<div class="company-cart company-cart_white company-cart_big">
							<img src="/imagecache/small/{{ $company->logo }}" alt="" class="company-cart__logo">
							<a href="{{ route('catalog.show', $company) }}" class="company-cart__name">{{ $company->name }}</a>
							<div class="company-cart__description">{{ $company->entry }}</div>
							<div class="container__row company-cart__bottom">
								<div class="container__col-6">
									<div class="company-cart__address">{{ $company->address }}</div>
									<div class="company-cart__post-date">
										Дата регистрации:
										{{ $company->created_at->format('m.d.Y') }}
									</div>
								</div>
								<div class="container__col-6">
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