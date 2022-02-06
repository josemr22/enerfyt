@component('mail::message')
    # Remitimos el detalle de tu pedido:

    <table border="3px" style="background-color: #eee;">
        <tr>
            <th>Cantidad</th>
            <th>Código de Producto</th>
            <th>Nombre</th>
            <th>Color</th>
            <th>Talla</th>
            <th>Precio</th>
        </tr>
        @foreach($cart as $item)
            <tr>
                <td>{{$item->qty}}</td>
                <td>{{$item->options->code}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->options->color->name}}</td>
                <td>{{$item->options->size->name}}</td>
                <td>{{number_format($item->price*$item->qty,2)}}</td>
            </tr>
        @endforeach
    </table>

    <p><strong>Total: </strong>{{number_format($finalTotal,2)}}</p>

    <p class="stext-117 cl6 p-b-26 text-justify">
        1.- Transferir o depositar en la cuenta en soles del Banco de Crédito del Perú: a nombre de
        Stephanie Alejo Quiróz número 305-94019866-0-47 o código interbancario 002-30519401986604710 .
        Te recomendamos que realices transferencias, ya que si haces depósitos en ventanilla o incluso en
        agentes, la entidad financiera cobra una comisión de S/.9,00 por operación . Por favor ten en
        cuenta este detalle, porque si eso ocurriera no podremos realizar el envío hasta que hayas cubierto ese
        importe adicional. La única operación de DEPÓSITO que no tiene cargo es la que se realiza en los
        Agentes de la ciudad de Chiclayo.
    </p>

    <p class="stext-117 cl6 p-b-26 text-justify">
        2.- Envíanos un mensaje a nuestro WhatsApp con la imagen del voucher del depósito al número "
    </p>

    <p class="stext-117 cl6 p-b-26 text-justify">
        3.- Llama al (074)517820 o escribe al +51 938 278 650, sólo si tienes dudas o consulta sobre el
        estado de tu pedido (las llamadas telefónicas solo las podremos recibir entre las 9 am a 2 pm y
        de 3 a 8 pm).
    </p>

    <p class="stext-117 cl6 p-b-26 text-justify">
        <strong>TOMAR EN CUENTA:</strong> Tu pedido impago solo permanecerá disponible por 4 horas,
        pasado este tiempo y de no haber enviado el voucher correspondiente será anulado.
    </p>

    @component('mail::button', ['url' => '/'])
        Ir a AM&D
    @endcomponent

    {{ config('app.name') }}
@endcomponent
