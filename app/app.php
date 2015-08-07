<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/contact.php";

    session_start();

    if (empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() {

        $output = "";

        $all_contacts = Contact::getAll();

        if (!empty($all_contacts)) {
            $output .= "
                <h1>Contact List</h1>
                <p>Here are all your contacts:</p>
            ";

            foreach (Contact::getAll() as $contact) {
                $output .= "<p>" . $contact->getDescription() . "</p>";
            }
        }

        $output .= "
            <form action='/contacts' method='post'>
                <label for='description'>Contact Description</label>
                <input id='description' name='description' type='text'>

                <button type='submit'>Add Contact</button>
            </form>
        ";

        $output .= "
            <form action='/delete_contacts' method='post'>
                <button type='submit'>Clear</button>
            </form>
        ";

        return $output;
    });

    $app->post("/contacts", function() {
        $contact = new Contact($_POST['description']);
        $contact->save();
        return "
            <h1>You created a contact!</h1>
            <p>" . $contact->getDescription() . "</p>
            <p><a href='/'>View your list of contacts.</a></p>
        ";
    });

    $app->post("/delete_contacts", function() {

        Contact::deleteAll();

        return "
            <h1>List cleared!</h1>
            <p><a href='/'>Home</a></p>
        ";
    });


    return $app;
?>
