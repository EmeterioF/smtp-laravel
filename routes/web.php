<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseOrder;
use App\Mail\Mailer;

Route::get('/', function () {
    return view('welcome');
});


//sends email with just text 
Route::get('send-email-mail', function () {
    
    //the mail function accepts a closure as its second argument, which allows you to configure the email message.
    // In this example, we are sending a simple raw email with the subject "Mailtrap is working!" to the recipient "
    Mail::raw('Mailtrap working', function ($message) {
        $message->to('emeterio2.figuracion@neu.edu.ph') //recipient email address
                ->subject('Mailtrap is working!'); //subject of the email
    });

    return 'Email was sent'; 
});

//sends email with a view
Route::get('send-view-email', function () {
    
    Mail::send(new PurchaseOrder); // it sends the email using the PurchaseOrder Mailable class, which is defined in the 
    // app/Mail/PurchaseOrder.php file. This class is responsible for constructing the email message, including the recipient,
    // subject, and content.

    return 'Purchase order sent';
});

//-----------------ACTIVITY-----------------
Route::get('/email-form', function () {
    return view('emails.mailForm');
});

Route::post('/send-email', function (Request $request) { // accepts the form data submitted from the email form and 
// sends an email using the Mail facade and the Mailer Mailable class.

    $attachmentPath = null;

    // Check if an attachment file was uploaded and store it if it exists
    if ($request->hasFile('attachment')) {
        $attachmentPath = $request->file('attachment')
            ->store('uploads', 'public'); // Store under storage/app/public/uploads
    }

    Mail::to($request->recipient)
        ->send(new Mailer(
            $request->subject,
            $request->body,
            $attachmentPath
        ));

    return "Email sent!";
});