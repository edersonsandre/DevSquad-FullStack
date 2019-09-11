Olá {!! $usuario->name!!} seu arquivo foi importado com sucesso!<br /><br />

Linhas importadas:<br />
- SUCESSSO: {!! !empty($log['success']) ? count($log['success']) : 0 !!}<br />
- FALHAS: {!! !empty($log['failure']) ? count($log['failure']) : 0 !!}
