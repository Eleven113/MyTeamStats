<?php

require('Controller/frontend.php');
require('Controller/frontend.php');
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        } elseif ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && (int)$_GET['id'] > 0) {
                post();
            } else {
                throw new Exception('Aucun billet envoyé');
            }
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && (int)$_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception("Impossible d'envoyer le formulaire");
            }
        } elseif ($_GET['action'] === 'pagePosts') {
            if (isset($_GET['id']) && (int)$_GET['id'] > 0) {
                pagePosts();
            } else {
                throw new Exception('Aucun billet envoyé');
            }
        } elseif ($_GET['action'] == 'createPost') {
            displayCreatePost();}
     else {
            throw new Exception('Administrateur non identifié');
            }
        } elseif ($_GET['action'] == 'newPost'){
        if (!empty($_POST['title']) && !empty($_POST['extract']) && !empty($_POST['content'])) {
            newPost($_POST['title'], $_POST['extract'], $_POST['content']);
        } else {
            throw new Exception('Contenu vide !');
        }
        }
        } else {
                listPosts();
            }
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }