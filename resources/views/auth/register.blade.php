@extends('layouts.app')


@section('content')
    <!-- Contact Page Section -->
    <div class="contact-page-section">
        <div class="auto-container">
            <!-- Form Boxed -->
            <div class="form-boxed pt-5">
                <div class="sec-title centered">
                    <h2>Форма <span>регистрации</span></h2>
                </div>

                @php($input = session()->hasOldInput() ? session()->getOldInput() : [])
                <div class="boxed-inner">
                    <div class="card my-3" id="regformtabs" role="tablist">
                        <ul class="nav nav-pills nav-fill"  role="presentation">
                            <li class="nav-item">
                                <a
                                    class="nav-link active"
                                    id="author-role-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#author"
                                    type="button"
                                    role="tab"
                                    aria-controls="author"
                                    aria-selected="true">
                                    Author
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    id="publisher-role-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#publisher"
                                    type="button"
                                    role="tab"
                                    aria-controls="publisher"
                                    aria-selected="false">
                                    Publisher
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="author" role="tabpanel" aria-labelledby="author-role-tab">
                            @include('auth.user_form')
                        </div>
                        <div class="tab-pane fade" id="publisher" role="tabpanel" aria-labelledby="publisher-role-tab">
                            @include('auth.publisher_form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
