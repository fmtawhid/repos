<div class="card">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('AI Engine Setup') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">            
            <div class="card">
                <div class="border-bottom position-relative">
                    <span class="nav-line-tab-left-arrow text-center cursor-pointer ms-2">
                        <i data-feather="chevron-left" class="icon-16"></i>
                    </span>
                    <ul class="nav nav-line-tab fw-medium px-3">
                        <li class="nav-item">
                            <a href="#{{appStatic()::ENGINE_OPEN_AI}}" class="nav-link active" data-bs-toggle="tab" aria-selected="true">
                                {{ ucfirst(appStatic()::ENGINE_OPEN_AI) }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#{{appStatic()::ENGINE_GEMINI_AI}}" class="nav-link" data-bs-toggle="tab" aria-selected="false">
                                {{ ucfirst(appStatic()::ENGINE_GEMINI_AI) }}
                            </a>
                        </li>                       
                    </ul>
                    <span class="nav-line-tab-right-arrow text-center cursor-pointer me-2">
                        <i data-feather="chevron-right" class="icon-16"></i>
                    </span>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="{{appStatic()::ENGINE_OPEN_AI}}">
                            @include('backend.admin.settings.credential-tab.inc.open-ai-tab')
                        </div>
                        <div class="tab-pane fade" id="{{appStatic()::ENGINE_GEMINI_AI}}">
                            @include('backend.admin.settings.credential-tab.inc.gemini-ai-tab')                            
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>