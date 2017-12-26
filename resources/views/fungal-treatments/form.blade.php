<div class="form-group {{ $errors->has('terbinafine_gel_applied') ? 'has-error' : ''}}">
    <label for="terbinafine_gel_applied" class="col-md-4 control-label">{{ 'Terbinafine Gel Applied' }}</label>
    <div class="col-md-6">
        <div class="radio">
    <label><input name="{{ terbinafine_gel_applied }}" type="radio" value="1" {{ (isset($fungaltreatment) && 1 == $fungaltreatment->terbinafine_gel_applied) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="{{ terbinafine_gel_applied }}" type="radio" value="0" @if (isset($fungaltreatment)) {{ (0 == $fungaltreatment->terbinafine_gel_applied) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
        {!! $errors->first('terbinafine_gel_applied', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('loceryl_applied') ? 'has-error' : ''}}">
    <label for="loceryl_applied" class="col-md-4 control-label">{{ 'Loceryl Applied' }}</label>
    <div class="col-md-6">
        <div class="radio">
    <label><input name="{{ loceryl_applied }}" type="radio" value="1" {{ (isset($fungaltreatment) && 1 == $fungaltreatment->loceryl_applied) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="{{ loceryl_applied }}" type="radio" value="0" @if (isset($fungaltreatment)) {{ (0 == $fungaltreatment->loceryl_applied) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
        {!! $errors->first('loceryl_applied', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('vaseline_gel_applied') ? 'has-error' : ''}}">
    <label for="vaseline_gel_applied" class="col-md-4 control-label">{{ 'Vaseline Gel Applied' }}</label>
    <div class="col-md-6">
        <div class="radio">
    <label><input name="{{ vaseline_gel_applied }}" type="radio" value="1" {{ (isset($fungaltreatment) && 1 == $fungaltreatment->vaseline_gel_applied) ? 'checked' : '' }}> Yes</label>
</div>
<div class="radio">
    <label><input name="{{ vaseline_gel_applied }}" type="radio" value="0" @if (isset($fungaltreatment)) {{ (0 == $fungaltreatment->vaseline_gel_applied) ? 'checked' : '' }} @else {{ 'checked' }} @endif> No</label>
</div>
        {!! $errors->first('vaseline_gel_applied', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
