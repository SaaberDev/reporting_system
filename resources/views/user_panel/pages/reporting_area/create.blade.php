@extends('user_panel.layouts.app')
@section('title', e($assets->company_name))

@push('styles')
    {{-- Internal CSS will go here --}}
@endpush

@section('content')
    <section>
        <div class="container">
            <div class="brand-part custom-bg">
                <div class="row py-5 pl-5 my-4 d-flex align-items-center">
                    <div class="col-12 col-md-2 text-right mb-3 mb-md-0">
                        <div class="brand-logo">
                            <div class="logo-shape">
                                <img src="{{ asset('storage/admin_panel/img/' . $assets->company_logo) }}" alt="">
                            </div>
                        </div>	<!-- brand-logo end -->
                    </div>	<!-- col end -->
                    <div class="col-12 col-md-10">
                        <div class="brand-content">
                            <h2>{{ $assets->company_name }}</h2>
                            <a href="{{ $assets->url }}">{{ $assets->url }}</a>
                        </div>	<!-- brand-content end -->
                    </div>	<!-- col end -->
                </div>	<!-- row end -->
            </div>	<!-- brand-part end -->

            <form action="{{ route('report.store', $assets->asset_slug) }}" method="POST">
                @method('POST')
                @csrf
                <div class="userName-part custom-bg">
                    <div class="row py-3 my-4 d-flex align-items-center">
                        <div class="col-12 col-md-4 mb-3 mb-md-0 text-center">
                            <div class="userName-heading">
                                <h3>Name</h3>
                            </div>
                        </div>	<!-- col end -->
                        <div class="col-12 col-md-8 px-5">
                            <div class="userName-input">
                                <input type="text" id="reporterName" name="reporterName" value="{{ old('reporterName') }}" class="form-control bg-dark text-white">
                            </div>
                        </div>	<!-- col end -->
                    </div>	<!-- row end -->
                </div>	<!-- userName-part end -->

                <div class="asset-part custom-bg">
                    <div class="row py-4 my-4 d-flex align-items-center">
                        <div class="col-md-4 text-center">
                            <div class="heading">
                                <h2>Asset</h2>
                            </div> <!-- heading end -->
                        </div>	<!-- col end -->
                        <div class="col-md-8 px-5">
                            <div class="asset-content">
                                @if($errors->has('RadioAsset'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('RadioAsset') }}</strong>
                                    </span>
                                @endif
                                <p>Select the attack surface of this issue.</p>
                                <input class="form-control " type="text" placeholder="Search" id="assetSearchInput">
                                <div class="inner-box">
                                    <div class="list-group scrollbar" id="assetList">
                                        @forelse($inScopeUrls ?: [] as $key => $OptionalUrl)
                                            <input type="radio" name="RadioAsset"
                                                   {{ old('RadioAsset') == change_http($OptionalUrl->value) ? 'checked='.'"'.'checked'.'"' : '' }}
                                                   value="{{ change_http($OptionalUrl->value) }}" id="RadioAsset{{ $key + 1 }}" />
                                            <label class="list-group-item" for="RadioAsset{{ $key + 1 }}">{{ change_http($OptionalUrl->value) }}</label>
                                        @empty
                                            <label class="list-group-item">No Data</label>
                                        @endforelse
                                    </div>	<!-- list-group & scrollbar end -->


                                    <div class="choiceLabel mb-3">
                                        <label for="">You Selected :</label>
                                        <input type="hidden" name="asset" id="RadioAssetValue" value="{{ old('asset') }}">
                                        <label for="asset_result" class="asset-result" id="choiceLabel1">{{ old('asset') }}</label>
                                        <a id="clear1" class="btn deselect"><span class="strick-line">( Deselect )</span></a>
                                    </div>	<!-- choiceLabel end -->
                                </div>	<!-- inner-box end -->
                            </div>	<!-- brand-content end -->
                        </div>	<!-- col end -->
                    </div>	<!-- row end -->
                </div>	<!-- asset-part end -->

                <div class="weakness-part custom-bg">
                    <div class="row py-4 my-4 d-flex align-items-center">
                        <div class="col-md-4 text-center">
                            <div class="heading">
                                <h2>Weakness</h2>
                            </div> <!-- heading end -->
                        </div>	<!-- col end -->
                        <div class="col-md-8 px-5">
                            <div class="asset-content">
                                @if($errors->has('RadioWeakness'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('RadioWeakness') }}</strong>
                                    </span>
                                @endif
                                <p>Select the type of the potential issue you have discovered. \ Can't pick just one? Select the best match or submit a separate report \ for each distinct weakness.</p>
                                <input class="form-control " type="text" placeholder="Search" id="weaknessSearchInput">
                                <div class="inner-box">
                                    <div class="list-group scrollbar" id="weaknessList">
                                        @foreach($weakness as $key => $weak)
                                        <input type="radio" name="RadioWeakness" {{ old('RadioWeakness') === $weak ? 'checked='.'"'.'checked'.'"' : '' }} value="{{ $weak }}" id="RadioWeakness{{ $key + 1 }}" />
                                        <label class="list-group-item" for="RadioWeakness{{ $key + 1 }}">{{ $weak }}</label>
                                        @endforeach
                                    </div>	<!-- list-group & scrollbar end -->

                                    <div class="choiceLabel mb-3">
                                        <label for="">You Selected :</label>
                                        <input type="hidden" name="weakness" value="{{ old('RadioWeakness') }}" id="RadioWeaknessValue">
                                        <label class="asset-result" id="choiceLabel2">{{ old('RadioWeakness') }}</label>
                                        <a id="clear2" class="btn deselect"><span class="strick-line">( Deselect )</span></a>
                                    </div>	<!-- choiceLabel end -->
                                    <div class="orBorder"><span>Others</span></div>
                                    <div class="others">
                                        <input id="otherWeakness" type="text" name="otherWeakness" value="{{ old('otherWeakness') }}" class="form-control" placeholder="Others">
                                    </div>
                                </div>	<!-- inner-box end -->
                            </div>	<!-- brand-content end -->
                        </div>	<!-- col end -->
                    </div>	<!-- row end -->
                </div>	<!-- Weakness-part end -->

                <div class="score-part custom-bg">
                    <div class="row py-4 my-4 d-flex align-items-center" >
                        <div class="col-12 col-md-4 text-center">
                            <div class="heading">
                                <h2>Threat Level</h2>
                            </div> <!-- heading end -->
                        </div>	<!-- col end -->
                        <div class="col-12 col-md-8 px-5">
                            @if($errors->has('cvssStatic'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('cvssStatic') }}</strong>
                                </span>
                            @endif
                            {{-- Static CVSS --}}
                            <div class="cvssjs radio" id="severity">
                                <dl class="AV AV-cust" id="getbtn">
                                    <!-- <dt>None</dt> -->
                                    <dd>
                                        <input name="cv" value="None" id="cv1" class="AVN" type="radio">
                                        <label for="cv1"><i class="AVN"></i>None </label>
                                    </dd>
                                    <dd>
                                        <input name="cv" value="Low" id="cv2" class="AVN" type="radio">
                                        <label for="cv2"><i class="AVN"></i>Low </label>
                                    </dd>
                                    <dd>
                                        <input name="cv" value="Medium" id="cv3" class="AVA" type="radio">
                                        <label for="cv3"><i class="AVA"></i>Medium </label>
                                    </dd>
                                    <dd>
                                        <input name="cv" value="High" id="cv4" class="AVL" type="radio">
                                        <label for="cv4"><i class="AVL"></i>High </label>
                                    </dd>
                                    <dd>
                                        <input name="cv" value="Critical" id="cv5" class="AVP" type="radio">
                                        <label for="cv5"><i class="AVP"></i>Critical </label>
                                    </dd>
                                    <div class="cust-result" for="c.valueStatic" id="showResult" style="">
                                        No Rating
                                    </div>
                                    <input type="hidden" name="cvssStatic" value="" id="c.valueStatic">
                                </dl>
                            </div>

                            <div id="orDiv">
                                <span>Or</span>
                                <span id="toggleCvss" class="btn btn-info">Use CVSS Calculator</span>
                            </div>

                            {{-- Multiple Option CVSS --}}
                            <div for="c.value" id="cvssboard">
                            </div>
                            <input type="hidden" name="cvssOptional" value="" id="c.value">
                        </div>	<!-- col end -->
                    </div>	<!-- row end -->
                </div>	<!-- score-part end -->

                <div class="submit-part custom-bg">
                    <div class="row py-4 my-4">
                        <div class="col-md-12 px-5">
                            <div class="asset-content">
                                <div class="inner-box">
                                    <h4>Title<span>*</span></h4>
                                    @if($errors->has('title'))
                                        <span class="text-danger">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                    <span>A clear and concise title includes the type of vulnerability and the impacted asset.</span>
                                    <input id="vul_title" type="text" class="form-control" name="title" value="{{ old('title') }}">
                                    <h5>Description<span>*</span></h5>
                                    @if($errors->has('desc'))
                                        <span class="text-danger">
                                        <strong>{{ $errors->first('desc') }}</strong>
                                    </span>
                                    @endif
                                    <span>What is the vulnerability? In clear steps, how do you reproduce it?</span>
                                    <div class="textarea">
                                        <div class="TextEditorArea">
                                            <textarea id="text1" class="TextEditorArea-field inner-scrollbar" name="desc">{{ old('desc') ? old('desc') : $vulnerabilityDefaultData }}</textarea>
                                            <div id="submitPrev" class="TextEditorArea-preview inner-scrollbar"></div>
                                            <div class="TextEditorArea-footer">
                                                <a class="TextEditorArea-footer-tab write TextEditorArea-footer-tab--active">Write</a>
                                                <a class="TextEditorArea-footer-tab preview">Preview</a>
                                                <div class="TextEditorArea-footer-message text-right">Parsed with
                                                    <a class="
												" target="_blank" rel="noopener noreferrer" href="https://docs.hackerone.com/programs/using-markdown.html" tabindex="-1">Markdown</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- textarea end -->
                                    <h5>Impact<span>*</span></h5>
                                    @if($errors->has('impact'))
                                        <span class="text-danger">
                                        <strong>{{ $errors->first('impact') }}</strong>
                                    </span>
                                    @endif
                                    <span>What security impact could an attacker achieve?</span>
                                    <div class="textarea">
                                        <div class="TextEditorArea">
                                            <textarea class="TextEditorArea-field inner-scrollbar" name="impact">{{ old('impact') ? old('impact') : $vulnerabilityDefaultData }}</textarea>
                                            <div class="TextEditorArea-preview inner-scrollbar"></div>
                                            <div class="TextEditorArea-footer">
                                                <a class="TextEditorArea-footer-tab TextEditorArea-footer-tab--active write">Write</a>
                                                <a class="TextEditorArea-footer-tab preview">Preview</a>
                                                <div class="TextEditorArea-footer-message text-right">Parsed with
                                                    <a class="
												" target="_blank" rel="noopener noreferrer" href="https://docs.hackerone.com/programs/using-markdown.html" tabindex="-1">Markdown</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- textarea end -->

                                    <h5>Step of Reproduce<span>*</span></h5>
                                    @if($errors->has('reproduce'))
                                        <span class="text-danger">
                                        <strong>{{ $errors->first('reproduce') }}</strong>
                                    </span>
                                    @endif
                                    <span>What is vulnerability? In clear steps, how do you reproduce it?</span>
                                    <div class="textarea">
                                        <div class="TextEditorArea">
                                            <textarea class="TextEditorArea-field inner-scrollbar" name="reproduce">{{ old('reproduce') ? old('reproduce') : $vulnerabilityDefaultData }}</textarea>
                                            <div id="prev1" class="TextEditorArea-preview inner-scrollbar"></div>
                                            <div class="TextEditorArea-footer">
                                                <a class="TextEditorArea-footer-tab TextEditorArea-footer-tab--active write">Write</a>
                                                <a class="TextEditorArea-footer-tab preview">Preview</a>
                                                <div class="TextEditorArea-footer-message text-right">Parsed with
                                                    <a class="
												" target="_blank" rel="noopener noreferrer" href="https://docs.hackerone.com/programs/using-markdown.html" tabindex="-1">Markdown</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- textarea end -->

                                    <h5>Exploitation<span>*</span></h5>
                                    @if($errors->has('exploitation'))
                                        <span class="text-danger">
                                        <strong>{{ $errors->first('exploitation') }}</strong>
                                    </span>
                                    @endif
                                    <span>What is vulnerability? In clear steps, how do you reproduce it?</span>
                                    <div class="textarea">
                                        <div class="TextEditorArea">
                                            <textarea class="TextEditorArea-field inner-scrollbar" name="exploitation">{{ old('exploitation') ? old('exploitation') : $vulnerabilityDefaultData }}</textarea>
                                            <div class="TextEditorArea-preview inner-scrollbar"></div>
                                            <div class="TextEditorArea-footer">
                                                <a class="TextEditorArea-footer-tab TextEditorArea-footer-tab--active write">Write</a>
                                                <a class="TextEditorArea-footer-tab preview">Preview</a>
                                                <div class="TextEditorArea-footer-message text-right">Parsed with
                                                    <a class="
												" target="_blank" rel="noopener noreferrer" href="https://docs.hackerone.com/programs/using-markdown.html" tabindex="-1">Markdown</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- textarea end -->

                                    <h5>Fixation<span>*</span></h5>
                                    @if($errors->has('fixation'))
                                        <span class="text-danger">
                                        <strong>{{ $errors->first('fixation') }}</strong>
                                    </span>
                                    @endif
                                    <span>What security impact could an attacker achieve?</span>
                                    <div class="textarea">
                                        <div class="TextEditorArea">
                                            <textarea class="TextEditorArea-field inner-scrollbar" name="fixation">{{ old('fixation') ? old('fixation') : $vulnerabilityDefaultData }}</textarea>
                                            <div class="TextEditorArea-preview inner-scrollbar"></div>
                                            <div class="TextEditorArea-footer">
                                                <a class="TextEditorArea-footer-tab TextEditorArea-footer-tab--active write">Write</a>
                                                <a class="TextEditorArea-footer-tab preview">Preview</a>
                                                <div class="TextEditorArea-footer-message text-right">Parsed with
                                                    <a class="
												" target="_blank" rel="noopener noreferrer" href="https://docs.hackerone.com/programs/using-markdown.html" tabindex="-1">Markdown</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- textarea end -->
                                </div>
                                <!-- inner-box end -->
                            </div>
                            <!-- brand-content end -->
                        </div>
                        <!-- col end -->
                    </div>
                    <!-- row end -->
                </div>


                <div class="submit-btn text-right">
                    <span class="">By clicking 'Submit Report', you agree to our <a href="">Terms and Conditions</a> and acknowledge that you have read our <a href="">Privacy Policy</a> and  <a href="">Disclosure Guidelines</a>.</span>
                    <!-- <a class="btn btn-success btn-md py-2 px-5 my-3 mb-5" href="formPreviewPage.html" data-toggle="modal" data-target="#exampleModal">Report Preview</a> -->

                    <button type="button" class="btn btn-success btn-md py-2 px-5 my-3 mb-5" id="submitBtn" data-toggle="modal" data-target="#preview-modal">
                        Report Preview
                    </button>

                    <!-- Modal -->
                        <div class="modal fade" id="preview-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog " role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="report-summ scrollbar">
                                            <div class="container ">
                                                <div class="row mt-4 mb-3 py-3">
                                                    <div class="offset-md-1"></div>
                                                    <!-- col end -->
                                                    <div class="col-md-11">
                                                        <div class="inner-report-summ">
                                                            <ul class="navbar-nav">
                                                                <li>Asset : <span id="prev_asset"></span> </li>
                                                                <li>Weakness : <span id="prev_weakness"></span> </li>
                                                                <li>Other Weakness : <span id="prev_otherWeakness"></span> </li>
                                                                <li>Threat level : <span id="prev_severityStatic"></span> </li>
                                                                <li>Threat level (CVSS) : <span id="prev_severity"></span> </li>
                                                                <li>Vulnerability Title : <span id="prev_title"></span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- col end -->
                                                </div>
                                                <!-- row end -->

                                                <div class="row custom-bg " id="prev_box">
                                                    <div class="col-md-12">

                                                    </div>
                                                    <!-- col end -->
                                                </div>
                                                <!-- row end -->
                                            </div>
                                            <!-- container end -->
                                        </div>
                                        <!-- report-summ end -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="mainFormSubmit">Report Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <!-- submit-btn end -->
            </form>
        </div>	<!-- container end -->
    </section>	<!-- section end -->
@stop

@push('scripts')
    {{-- Internal JS will go here --}}
@endpush
