<div id="slide2" class="tab-pane fade in row" role="tabpanel">
    <div class="col-md-8">
        <div class="form-wrap">
            <div class="form-group">
                <label class="control-label mb-10" for="exampleInputuname_2">عنوان اسلاید 2</label>
                <div class="input-group">
                    <input type="text" @isset($edit) value="{{$selected->name}}" @else value="{{old('name')}}" @endisset name="name" class="form-control" id="exampleInputuname_2" placeholder="برای مثال : Apple_iPhone_X_back">
                    <div class="input-group-addon"><i class="icon-picture"></i></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label mb-10" for="exampleInputEmail_2">متن توضیح اسلاید 1</label>
                <div class="input-group">
                    <input type="text" @isset($edit) value="{{$selected->description}}" @else value="{{old('description')}}" @endisset name="description" class="form-control" id="exampleInputEmail_2" placeholder="یک توضیح کوتاه یک خطی درباره عکس">
                    <div class="input-group-addon"><i class="icon-speech"></i></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <label class="control-label mb-10" for="exampleInputEmail_4">عنوان دکمه اسلاید 1</label>
                    <div class="input-group">
                        <input type="text" @isset($edit) value="{{$selected->description}}" @else value="{{old('description')}}" @endisset name="description" class="form-control" id="exampleInputEmail_4" placeholder="یک توضیح کوتاه یک خطی درباره عکس">
                        <div class="input-group-addon"><i class="icon-speech"></i></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="control-label mb-10" for="exampleInputEmail_5">لینک دکمه اسلاید 1</label>
                    <div class="input-group">
                        <input type="text" @isset($edit) value="{{$selected->description}}" @else value="{{old('description')}}" @endisset name="description" class="form-control" id="exampleInputEmail_5" placeholder="یک توضیح کوتاه یک خطی درباره عکس">
                        <div class="input-group-addon"><i class="icon-speech"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <label class="control-label mb-10">تصویر اسلاید 1</label>
        <div class="mt-10 mb-10">
            <input type="file" @isset($edit) data-default-file="/uploads/{{$selected->photo}}" disabled @endisset name="photo" id="input-file-now" class="dropify" />
        </div>	
    </div>
</div>