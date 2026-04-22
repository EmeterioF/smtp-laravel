<form action="/send-email" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="email" name="recipient" placeholder="Recipient Email" required>
    <br><br>

    <input type="text" name="subject" placeholder="Subject" required>
    <br><br>

    <textarea name="body" placeholder="Message Body" required></textarea>
    <br><br>

    <input type="file" name="attachment">
    <br><br>

    <button type="submit">Send Email</button>
</form>