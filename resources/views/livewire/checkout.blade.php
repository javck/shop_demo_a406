<div>
    <div class="creat_account">
        <input type="checkbox" id="f-option4" name="selector" wire:model="isChecked" />
        <label for="f-option4">已閱讀所有 </label>
        <a href="#">terms & conditions*</a>
      </div>
      @if($isChecked)
        <a class="btn_3" href="{{ url('/pay') }}">使用綠界付款</a>
      @endif
      
</div>
