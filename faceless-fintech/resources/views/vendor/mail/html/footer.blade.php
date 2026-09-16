<hr>
DISCLAIMER: this message was automatically generated via {{$settings->site_name.com}} secured online channel, please do not reply this message. all correspondent should be address to customer Services.<br>
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')<br>

<tr>
<td>
    
<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content-cell" align="center">
  
{{$settings->address}}  
{{ Illuminate\Mail\Markdown::parse($slot) }}
</td>
</tr>
</table>
</td>
</tr>
