<div class="container">
    <div class="form-group form-row">
        <div class="col-12 col-sm-5">
            <input type="text" id="cardNumber" data-checkout="cardNumber"
            onselectstart="return false" onpaste="return false"
            oncopy="return false" oncut="return false"
            ondrag="return false" ondrop="return false" autocomplete=off
            class="form-control"
            placeholder="Número de Tarjeta">
        </div><div class="col-12  col-sm-2">
            <input id="securityCode" data-checkout="securityCode" type="text"
            onselectstart="return false" onpaste="return false"
            oncopy="return false" oncut="return false"
            ondrag="return false" ondrop="return false" autocomplete=off
            placeholder="CVC"
            class="form-control">
        </div>

        <div class="col-0  col-sm-1"></div>

        <div class="col-6  col-sm-2">
            <input type="text" placeholder="MM" id="cardExpirationMonth" data-checkout="cardExpirationMonth"
            onselectstart="return false" onpaste="return false"
            oncopy="return false" oncut="return false"
            ondrag="return false" ondrop="return false" autocomplete=off
            placeholder="MM"
            class="form-control">
        </div>

        <div class="col-6  col-sm-2">
            <input type="text" placeholder="YY" id="cardExpirationYear" data-checkout="cardExpirationYear"
            onselectstart="return false" onpaste="return false"
            oncopy="return false" oncut="return false"
            ondrag="return false" ondrop="return false" autocomplete=off
            placeholder="AA"
            class="form-control">
        </div>
    </div>

    <div class="form-group form-row">
        <div class="col-lg-12">
            <input id="cardholderName" class="form-control" data-checkout="cardholderName" type="text" placeholder="Titular">
        </div>
    </div>

    <div class="form-group form-row">
        <div class="col-4 col-lg-6">
            <select class="form-control form-control-sm" id="docType" name="docType" data-checkout="docType" type="text"></select>
        </div>
        <div class="col-8 col-lg-6">
            <input class="form-control" id="docNumber" name="docNumber" data-checkout="docNumber" type="text" placeholder="Número de Doc"/>
        </div>
    </div>

    {{-- <div class="form-group form-row">
        <div class="col">
            <small class="form-text text-danger" id="paymentErrors" role="alert"></small>
        </div>
    </div> --}}

    <input type="hidden" name="transactionAmount" id="transactionAmount" x-model="total" />
    <input type="hidden" name="paymentMethodId" id="paymentMethodId" />
    <input type="hidden" name="description" id="description" />
</div>
