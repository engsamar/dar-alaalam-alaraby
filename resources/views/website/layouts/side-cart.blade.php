 <div class="offcanvas-header">
     <h5>@lang('website.ThereAre') <span class="pro-count">{{ $sideCart['itemCount'] ?? 0 }}</span>
         @lang('website.productCarts')</h5>
     <button type="button" class="close-shop-card" data-bs-dismiss="offcanvas" aria-label="Close"><svg
             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 511.995 511.995">
             <path
                 d="M437.126,74.939c-99.826-99.826-262.307-99.826-362.133,0C26.637,123.314,0,187.617,0,256.005 s26.637,132.691,74.993,181.047c49.923,49.923,115.495,74.874,181.066,74.874s131.144-24.951,181.066-74.874 C536.951,337.226,536.951,174.784,437.126,74.939z M409.08,409.006c-84.375,84.375-221.667,84.375-306.042,0 c-40.858-40.858-63.37-95.204-63.37-153.001s22.512-112.143,63.37-153.021c84.375-84.375,221.667-84.355,306.042,0 C493.435,187.359,493.435,324.651,409.08,409.006z">
             </path>
             <path
                 d="M341.525,310.827l-56.151-56.071l56.151-56.071c7.735-7.735,7.735-20.29,0.02-28.046 c-7.755-7.775-20.31-7.755-28.065-0.02l-56.19,56.111l-56.19-56.111c-7.755-7.735-20.31-7.755-28.065,0.02 c-7.735,7.755-7.735,20.31,0.02,28.046l56.151,56.071l-56.151,56.071c-7.755,7.735-7.755,20.29-0.02,28.046 c3.868,3.887,8.965,5.811,14.043,5.811s10.155-1.944,14.023-5.792l56.19-56.111l56.19,56.111 c3.868,3.868,8.945,5.792,14.023,5.792c5.078,0,10.175-1.944,14.043-5.811C349.28,331.117,349.28,318.562,341.525,310.827z">
             </path>
         </svg>
     </button>
 </div>
 <div class="offcanvas-body">
     <ul>
         @if (!empty($sideCart['items']))
             @foreach ($sideCart['items'] as $cartItem)
                 <li>
                     <div class="pro-img">
                         <a href="{{ $cartItem->url }}"><img src="{{ imagePath($cartItem->product->image) }}"
                                 alt="product"></a>
                     </div>
                     <div class="pro-content">
                         <h6>{{ $cartItem->product->title }}</h6>
                         <div class="cart-qty-price">
                             <span class="quantity">{{ $cartItem->quantity }} x</span>
                             <span
                                 class="price-box">{{ $cartItem->product->price_after > 0 ? $cartItem->product->price_after : $cartItem->product->price }}
                                 @lang('website.currency')</span>
                         </div>
                     </div>
                     <button data-slug="{{ $cartItem->product->slug }}" class="remove-item-btn remove-product"><svg
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                             <path
                                 d="M15.84 22.25H8.16a3.05 3.05 0 0 1-3-2.86L4.25 5.55a.76.76 0 0 1 .2-.55.77.77 0 0 1 .55-.25h14a.75.75 0 0 1 .75.8l-.87 13.84a3.05 3.05 0 0 1-3.04 2.86zm-10-16 .77 13.05a1.55 1.55 0 0 0 1.55 1.45h7.68a1.56 1.56 0 0 0 1.55-1.45l.81-13z">
                             </path>
                             <path d="M21 6.25H3a.75.75 0 0 1 0-1.5h18a.75.75 0 0 1 0 1.5z">
                             </path>
                             <path
                                 d="M15 6.25H9a.76.76 0 0 1-.75-.75V3.7a2 2 0 0 1 1.95-1.95h3.6a2 2 0 0 1 1.95 2V5.5a.76.76 0 0 1-.75.75zm-5.25-1.5h4.5v-1a.45.45 0 0 0-.45-.45h-3.6a.45.45 0 0 0-.45.45zM15 18.25a.76.76 0 0 1-.75-.75v-8a.75.75 0 0 1 1.5 0v8a.76.76 0 0 1-.75.75zM9 18.25a.76.76 0 0 1-.75-.75v-8a.75.75 0 0 1 1.5 0v8a.76.76 0 0 1-.75.75zM12 18.25a.76.76 0 0 1-.75-.75v-8a.75.75 0 0 1 1.5 0v8a.76.76 0 0 1-.75.75z">
                             </path>
                         </svg>
                     </button>
                 </li>
             @endforeach
         @endif
     </ul>
 </div>
 <div class="offcanvas-footer">
     <div class="total-price-content">
         <h6>@lang('website.TotalAmount')</h6>
         <span class="prices">{{ !empty($sideCart['totalCartPrice']) ? $sideCart['totalCartPrice'] : 0 }}
             @lang('website.currency')</span>
     </div>
     <a href="{{ route('website.carts.index',['locale' => $locale]) }}" class="link-anime v1">@lang('website.viewCart')</a>
 </div>
