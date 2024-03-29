<p>Olá {{ $user->username }},</p>

<p>Você requisitou a alteração de senha da sua conta {{ config('app.name')}}. Por favor, clique no link abaixo.</p>

<table role="presentation" border="0" cellspacing="0" class="btn btn-primary">
    <tbody>
        <tr>
            <td align="center">
                <table role="presentation" border="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td><a href="{{ $resetPasswordLink }}" target="_blank">REDEFINIR E-MAIL</a></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

<p>Ou, simplesmente copie e cole o link abaixo em seu navegador</p>
<p>Link para redefinir senha: {{ $resetPasswordLink }}</p>

<span>Por favor, ignore este email se você não requisitou alteração de senha.</span>