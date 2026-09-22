<x-mail::message>
# Bienvenido al Sistema de Capacitación

Estimado/a **{{ $user->first_name }} {{ $user->last_name }}**,

Ha sido registrado en el **Sistema de Gestión de Capacitación** del Hospital General de Occidente de Quetzaltenango.

Para activar su cuenta y establecer su contraseña, haga clic en el siguiente botón:

<x-mail::button :url="$activationUrl" color="primary">
Activar mi cuenta
</x-mail::button>

**Este enlace expirará en 24 horas.**

Si no esperaba esta invitación, puede ignorar este mensaje.

Atentamente,
**Hospital General de Occidente**
Departamento de Recursos Humanos
</x-mail::message>
