<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Website Enquiry — OriginSpaces</title>
</head>
<body style="margin:0;padding:0;background-color:#FAF9F5;font-family:'Plus Jakarta Sans',Arial,Helvetica,sans-serif;-webkit-font-smoothing:antialiased;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#FAF9F5;">
<tr>
<td align="center" style="padding:28px 12px;">
<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background-color:#ffffff;border:1px solid #e5e2da;border-radius:18px;overflow:hidden;">
<!-- Header -->
<tr>
<td style="background-color:#181B20;padding:28px 32px 24px;text-align:center;">
<div style="font-family:'JetBrains Mono',Courier,monospace;font-size:11px;letter-spacing:0.28em;text-transform:uppercase;color:#c5a880;margin-bottom:10px;">OriginSpaces UK &middot; Modular Architecture</div>
<div style="font-family:'Cormorant Garamond',Georgia,'Times New Roman',serif;font-size:32px;line-height:1.15;color:#ffffff;font-weight:600;">Origin<span style="color:#c5a880;">Spaces</span></div>
<div style="margin-top:8px;">
<a href="https://originspaces.uk" style="color:#9ca3af;text-decoration:none;font-size:13px;font-family:'JetBrains Mono',Courier,monospace;letter-spacing:0.12em;">https://originspaces.uk</a>
</div>
</td>
</tr>
<!-- Intro -->
<tr>
<td style="padding:28px 32px 6px;">
<div style="font-family:'JetBrains Mono',Courier,monospace;font-size:11px;letter-spacing:0.3em;text-transform:uppercase;color:#9a7b4f;font-weight:600;">New Website Enquiry</div>
<div style="font-family:'Cormorant Garamond',Georgia,'Times New Roman',serif;font-size:26px;line-height:1.2;color:#1a1d24;font-weight:600;margin-top:10px;">You have a new enquiry from {{ $contact->name }}</div>
<p style="font-size:14px;line-height:1.7;color:#374151;margin:12px 0 0;">A visitor has submitted the contact form on <a href="https://originspaces.uk" style="color:#9a7b4f;text-decoration:none;font-weight:600;">originspaces.uk</a>. Reply directly to this email to respond.</p>
</td>
</tr>
<!-- Details -->
<tr>
<td style="padding:20px 32px 0;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e5e2da;border-radius:12px;overflow:hidden;">
<tr style="background-color:#FAF8F5;">
<td style="padding:10px 14px;font-size:11px;letter-spacing:0.18em;text-transform:uppercase;color:#9a7b4f;font-family:'JetBrains Mono',Courier,monospace;font-weight:600;border-bottom:1px solid #e5e2da;" colspan="2">Enquiry Details</td>
</tr>
<tr>
<td style="padding:12px 14px;font-size:12px;color:#6b7280;font-family:'JetBrains Mono',Courier,monospace;text-transform:uppercase;letter-spacing:0.08em;width:140px;border-bottom:1px solid #F0EDE4;">Full Name</td>
<td style="padding:12px 14px;font-size:14px;color:#1a1d24;font-weight:600;border-bottom:1px solid #F0EDE4;">{{ $contact->name }}</td>
</tr>
<tr>
<td style="padding:12px 14px;font-size:12px;color:#6b7280;font-family:'JetBrains Mono',Courier,monospace;text-transform:uppercase;letter-spacing:0.08em;border-bottom:1px solid #F0EDE4;">Email</td>
<td style="padding:12px 14px;font-size:14px;border-bottom:1px solid #F0EDE4;"><a href="mailto:{{ $contact->email }}" style="color:#9a7b4f;text-decoration:none;font-weight:600;">{{ $contact->email }}</a></td>
</tr>
<tr>
<td style="padding:12px 14px;font-size:12px;color:#6b7280;font-family:'JetBrains Mono',Courier,monospace;text-transform:uppercase;letter-spacing:0.08em;border-bottom:1px solid #F0EDE4;">Phone</td>
<td style="padding:12px 14px;font-size:14px;color:#1a1d24;border-bottom:1px solid #F0EDE4;"><a href="tel:{{ $contact->phone }}" style="color:#1a1d24;text-decoration:none;">{{ $contact->phone }}</a></td>
</tr>
@if($contact->postcode)
<tr>
<td style="padding:12px 14px;font-size:12px;color:#6b7280;font-family:'JetBrains Mono',Courier,monospace;text-transform:uppercase;letter-spacing:0.08em;border-bottom:1px solid #F0EDE4;">Postcode / Town</td>
<td style="padding:12px 14px;font-size:14px;color:#1a1d24;border-bottom:1px solid #F0EDE4;">{{ $contact->postcode }}</td>
</tr>
@endif
<tr>
<td style="padding:12px 14px;font-size:12px;color:#6b7280;font-family:'JetBrains Mono',Courier,monospace;text-transform:uppercase;letter-spacing:0.08em;border-bottom:1px solid #F0EDE4;">Subject</td>
<td style="padding:12px 14px;font-size:14px;color:#1a1d24;border-bottom:1px solid #F0EDE4;">{{ $contact->subject ?: 'Website Enquiry' }}</td>
</tr>
<tr>
<td style="padding:12px 14px;font-size:12px;color:#6b7280;font-family:'JetBrains Mono',Courier,monospace;text-transform:uppercase;letter-spacing:0.08em;">Received</td>
<td style="padding:12px 14px;font-size:14px;color:#1a1d24;">{{ $contact->created_at ? $contact->created_at->format('d M Y, H:i') : now()->format('d M Y, H:i') }}</td>
</tr>
</table>
</td>
</tr>
<!-- Message -->
<tr>
<td style="padding:20px 32px 0;">
<div style="font-family:'JetBrains Mono',Courier,monospace;font-size:11px;letter-spacing:0.18em;text-transform:uppercase;color:#9a7b4f;font-weight:600;margin-bottom:10px;">Message</div>
<div style="background-color:#FAF8F5;border:1px solid #e5e2da;border-radius:12px;padding:16px;font-size:14px;line-height:1.75;color:#1a1d24;">{!! nl2br(e($contact->message)) !!}</div>
</td>
</tr>
<!-- CTA -->
<tr>
<td style="padding:24px 32px 6px;text-align:center;">
<a href="mailto:{{ $contact->email }}?subject={{ urlencode('Re: Your enquiry — OriginSpaces') }}" style="display:inline-block;background-color:#181B20;color:#ffffff;text-decoration:none;font-size:12px;font-weight:600;letter-spacing:0.16em;text-transform:uppercase;padding:14px 28px;border-radius:10px;">Reply to {{ $contact->name }}</a>
<p style="font-size:12px;line-height:1.6;color:#6b7280;margin:14px 0 0;">This reply goes directly to <a href="mailto:{{ $contact->email }}" style="color:#9a7b4f;text-decoration:none;font-weight:600;">{{ $contact->email }}</a>. We aim to reply within one working day.</p>
</td>
</tr>
<!-- Footer -->
<tr>
<td style="background-color:#FAF9F5;border-top:1px solid #e5e2da;padding:20px 32px;text-align:center;">
<div style="font-family:'Cormorant Garamond',Georgia,'Times New Roman',serif;font-size:18px;color:#1a1d24;font-weight:600;">OriginSpaces Modular UK</div>
<div style="font-size:12px;line-height:1.7;color:#6b7280;margin-top:6px;">
<a href="https://originspaces.uk" style="color:#9a7b4f;text-decoration:none;">https://originspaces.uk</a>
@if($company->phone1)<br><a href="tel:{{ $company->phone1 }}" style="color:#374151;text-decoration:none;">{{ $company->phone1 }}</a>@endif
@if($company->email1)&middot; <a href="mailto:{{ $company->email1 }}" style="color:#374151;text-decoration:none;">{{ $company->email1 }}</a>@endif
@if($company->address1)<br>{{ $company->address1 }}@endif
</div>
<div style="font-family:'JetBrains Mono',Courier,monospace;font-size:10px;letter-spacing:0.18em;text-transform:uppercase;color:#9ca3af;margin-top:12px;">Automated notification &middot; originspaces.uk</div>
</td>
</tr>
</table>
<p style="font-size:11px;color:#9ca3af;text-align:center;margin:14px 0 0;font-family:'JetBrains Mono',Courier,monospace;">If this enquiry is not for you, please ignore this email.</p>
</td>
</tr>
</table>
</body>
</html>
