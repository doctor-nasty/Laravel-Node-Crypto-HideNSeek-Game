
       

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

      @if(session()->get('success'))
        <div class="alert alert-success">
          {{ session()->get('success') }}
        </div>
      @endif
        <div class="row">

            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
					
                        <div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
                            <h4 class="card-title mb-0">@lang('gameedit.edit') {{ $game->title }}</h4>
							
                            <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-expanded="true">@lang('gameedit.basic')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="avatar-tab" data-toggle="tab" href="#avatar" role="tab" aria-controls="avatar">@lang('gameedit.full')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security">@lang('gameedit.photo')</a>
                                </li>
                            </ul>
							<button style="color:white" type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="wrapper">
                            <hr>
                            <div style="padding: 0 !important;" class="tab-content border-0" id="myTabContent">
                                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info">
                        <form enctype="multipart/form-data" method="post" action="{{ route('games.update', $game->id) }}">
                                    @method('PATCH')
                                        @csrf
                                    <div class="form-group">
                                        <label for="title">@lang('gameedit.title') *</label>
                                        <input id="title" name="title" type="text" class="required form-control" value="{{ $game->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">@lang('gameedit.type') *</label>
                                        <select id="type" name="type" type="text" class="required form-control" value="{{ $game->type }}">
                                            <option>@lang('gameedit.item')</option>
                                            <option>@lang('gameedit.code')</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">@lang('gameedit.comment') *</label>
                                        <input id="comment" name="comment" type="text" class="required form-control" value="{{ $game->comment }}">
                                    </div>
                                    <small>(*) @lang('gameedit.mandatory')</small>
                                        <div class="form-group mt-5">
                                            <button type="submit" class="btn btn-inverse-success mr-2">@lang('gameedit.update')</button>
                                        </div>
                                </div>
								</form>
                                <!-- tab content ends -->
                                <div class="tab-pane fade" id="avatar" role="tabpanel" aria-labelledby="avatar-tab">
                                    <div class="form-group">
                                        <label for="full_comment">@lang('gameedit.full_description') *</label>
                                        <input type="textarea" rows="5" id="clipboardExample2" class="required form-control" name="full_comment" value="{{ $game->full_comment }}"></input>
                                    </div>
                                        <div class="form-group">
                                            <label for="city">@lang('gameedit.city') *</label>
                                            <select id="city" name="city" type="text" class="required js-example-basic-single" style="width:100%" value="{{ $game->city }}">
                                                <option>თბილისი</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="district">@lang('gameedit.district') *</label>
                                            <select id="district" name="district" type="text" class="required js-example-basic-single" style="width:100%" value="{{ $game->district }}">
                                                <option disabled>აირჩიეთ უბანი</option>
                                                <option>აბანოთუბანი</option>
                                                <option>ავლაბარი</option>
                                                <option>ავჭალა</option>
                                                <option>ანჩისხატის უბანი</option>
                                                <option>ბეთლემი</option>
                                                <option>ბაგები</option>
                                                <option>გარეთუბანი</option>
                                                <option>გლდანის მასივი</option>
                                                <option>გლდანულა</option>
                                                <option>დამპალო</option>
                                                <option>დელისი</option>
                                                <option>დიდი დიღომი</option>
                                                <option>დიდუბე</option>
                                                <option>დიღმის მასივი</option>
                                                <option>ვაზისუბანი</option>
                                                <option>ვაკე</option>
                                                <option>ვარკეთილი</option>
                                                <option>ვაშლიჯვარი</option>
                                                <option>ვერა</option>
                                                <option>ვეძისი</option>
                                                <option>ზემელი</option>
                                                <option>ზღვისუბანი</option>
                                                <option>კრწანისი</option>
                                                <option>კუკია</option>
                                                <option>ლეღვთახევი</option>
                                                <option>ლოტკინი</option>
                                                <option>მეტეხი</option>
                                                <option>მთაწმინდა</option>
                                                <option>მუხიანი</option>
                                                <option>რიყე</option>
                                                <option>ნავთლუღი</option>
                                                <option>ნაძალადევი</option>
                                                <option>ორბელიანთუბანი</option>
                                                <option>ორთაჭალა</option>
                                                <option>საბურთალო</option>
                                                <option>სამგორი</option>
                                                <option>სანზონა</option>
                                                <option>სვანეთისუბანი</option>
                                                <option>სემიონოვკა</option>
                                                <option>სოლოლაკი</option>
                                                <option>სიონისუბანი</option>
                                                <option>ფიქრის გორა</option>
                                                <option>ფონიჭალა</option>
                                                <option>ჩუღურეთი</option>
                                                <option>10</option>
                                            </select>
                                        </div>
                                    <div class="form-group">
                                        <label for="points">@lang('gameedit.points')</label>
                                        <select id="points" name="points" type="text" class="form-control" disabled="disabled" value="{{ $game->points }}">
                                            <option>10</option>
                                            <option>20</option>
                                        </select>
                                        <small>@lang('gameedit.points_text')</small>
                                    </div>
                                    <small>(*) @lang('gameedit.mandatory')</small>
                                    <br>
                                    <br>
                                        <button type="submit" class="btn btn-success mr-2">@lang('gameedit.update')</button>
                                </div>
                                <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                                        <div class="wrapper mb-5 mt-4">
                                        <span class="badge badge-warning text-white">@lang('gameedit.note') : </span>
                                        <p class="d-inline ml-3 text-muted">@lang('gameedit.image_text') .</p>
                                    </div>
                                    <div class="form-group">
                                            <input type="file" class="dropfiy" name="photo" id="photoFile" aria-describedby="fileHelp">
                                        </div>
                                        <button type="submit" class="btn btn-success mr-2">@lang('gameedit.update')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
