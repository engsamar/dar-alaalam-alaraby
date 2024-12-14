@extends('website.layouts.app')
@section('title', __('titles.faqs'))

@section('content')
    @includeIf('website.layouts.title', ['title' => __('titles.faqs')])
    <div class="faq-area ptb-100">
        <div class="container">
            <div class="faq-accordion accordion" id="faqAccordion">
                @php
                    $count = 0;
                @endphp
                @if (!empty($result['items']))
                    @foreach ($result['items'] as $item)
                        <div class="accordion-item">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false" aria-controls="collapse-{{ $item->id }}">
                                <span>Que:</span> {!! $item->title !!}
                            </button>
                            <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse {{ $count == 0 ? 'show' : '' }}" aria-labelledby="heading-{{ $item->id }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    <span class="title">Ans:</span>
                                    <p>
                                        {!! $item->description !!}
                                    </p>
                                </div>
                            </div>

                        </div>
                        @php
                            $count++;
                        @endphp
                    @endforeach
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        {!! $result['items']->withQueryString()->links() !!}

                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection
