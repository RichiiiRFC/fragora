@extends('plantillaContent')

@section('titulo', 'Aviso Legal')

@section('contenido')
    <h1>Aviso Legal</h1>

    <p><b>Última actualización:</b> Noviembre de 2024</p>

    <h2>1. Información general</h2>
    <p>En cumplimiento con la legislación española vigente, a continuación se presentan los datos de la entidad titular de
        este sitio web:</p>
    <ul>
        <li><strong>Razón social:</strong> Fragora S.A.</li>
        <li><strong>CIF/NIF:</strong> A12345678</li>
        <li><strong>Dirección:</strong> Calle de la
            Innovación, 45, 28010, Madrid, España.</li>
        <li><strong>Correo electrónico:</strong> <a href="mailto:fragoraperfumes@gmail.com">fragoraperfumes@gmail.com</a>
        </li>
        <li><strong>Teléfono:</strong> +34 123 456 789</li>
    </ul>

    <h2>2. Condiciones de uso</h2>
    <p>Al acceder y utilizar este sitio web, aceptas los siguientes términos y condiciones de uso:</p>
    <ul>
        <li><strong>Acceso al sitio:</strong> El acceso a este sitio es gratuito, pero puede estar sujeto a algunas
            condiciones o restricciones según el servicio que utilices (por ejemplo, la compra de productos).</li>
        <li><strong>Uso del contenido:</strong> Los contenidos de este sitio web (textos, imágenes, logotipos, diseños,
            software, etc.) son propiedad de <strong>Fragora</strong> o de sus licenciantes, y están protegidos por las
            leyes de propiedad intelectual.</li>
        <li><strong>Uso no autorizado:</strong> Queda prohibido el uso no autorizado de los contenidos del sitio web,
            incluyendo su reproducción, distribución o modificación sin el consentimiento explícito de la empresa.</li>
        <li><strong>Responsabilidad:</strong> <strong>Fragora</strong> no se hace responsable de los daños o perjuicios
            derivados del uso indebido de este sitio web o de los contenidos que en él se publican.</li>
    </ul>

    <h2>3. Propiedad intelectual e industrial</h2>
    <p>Todos los contenidos del sitio web, incluidos textos, imágenes, logotipos, iconos, software y cualquier otro
        material, son propiedad de <strong>Fragora S.A.</strong> o de terceros que han autorizado su uso. Estos contenidos
        están protegidos por las leyes de propiedad intelectual e industrial.</p>

    <p>Queda expresamente prohibida la reproducción, distribución, modificación, comunicación pública o cualquier otra forma
        de explotación sin la autorización previa y por escrito de <strong>Fragora S.A.</strong></p>

    <h2>4. Política de privacidad y protección de datos</h2>
    <p>Tu privacidad es importante para nosotros. En <strong>Fragora</strong>, tratamos tus datos personales conforme al
        <strong>Reglamento General de Protección de Datos (RGPD)</strong> y la <strong>Ley Orgánica 3/2018</strong> de
        Protección de Datos Personales y Garantía de los Derechos Digitales.
    </p>
    <p>Para más detalles sobre cómo tratamos tus datos personales, consulta nuestra <a
            href="{{ url('/politica-privacidad') }}">Política de Privacidad</a>.</p>

    <h2>5. Enlaces a sitios web de terceros</h2>
    <p>Este sitio web puede contener enlaces a otros sitios web. <strong>Fragora</strong> no asume ninguna responsabilidad
        sobre el contenido de estos sitios externos y no tiene control sobre sus políticas de privacidad. Te recomendamos
        que leas sus avisos legales y políticas de privacidad antes de proporcionarles tus datos personales.</p>

    <h2>6. Modificaciones del aviso legal</h2>
    <p><strong>Fragora</strong> se reserva el derecho de modificar, en cualquier momento y sin previo aviso, este Aviso
        Legal. Las modificaciones entrarán en vigor desde su publicación en este sitio web. Te recomendamos que revises este
        Aviso Legal con regularidad para estar informado sobre cualquier cambio.</p>

    <h2>7. Legislación aplicable y jurisdicción</h2>
    <p>Este Aviso Legal se regirá e interpretará de acuerdo con las leyes de España. Para la resolución de cualquier
        controversia derivada del uso de este sitio web, las partes se someterán a los tribunales competentes de la ciudad
        de <strong>Madrid</strong>, renunciando expresamente a cualquier otro fuero que pudiera corresponderles.</p>

@endsection
