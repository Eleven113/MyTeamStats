{% extends "layout.html.twig" %}

{% block head %}
<title>Créér un joueur - MyTeamStats</title>
{% endblock %}

{% block content %}

<div id="creatematch_form" class="d-flex flex-column justify-content-center align-items-center">
    <form id="creatematch-form" class="col-lg-6" action="/MyTeamStats/AddMatch"  method="post" enctype="multipart/form-data">
        <legend>Créér un match</legend>
        <div class="form-group">
            <label for="text">Date</label>
            <input id="text" type="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="text">Adversaire</label>
            <select name="category">
                {% for oppo in oppoListObj %}
                    <option value="{{ oppo.opponentid }}">{{ oppo.name }}</option>
                {% endfor %}
            </select>
        </div>
        <div class="form-groupe">
            <p>Lieu:</p>
            <div>
                <input type="radio" id="home" name="athome" value= "1"
                       checked>
                <label for="home">Domicile</label>
            </div>
            <div>
                <input type="radio" id="away" name="athome" value="0">
                <label for="away">Extérieur</label>
            </div>
        </div>
        <div class="form-group">
            <label for="text">Adresse</label>
            <input id="text" type="text" name="$location" class="form-control">
        </div>
        <div class="form-group">
            <label for="text">Catégorie</label>
            <select name="category">
                <option value="U18">U18</option>
                <option value="U15">U15</option>
            </select>
        </div>
        <div class="form-group">
            <label for="text">Compétition</label>
            <input id="text" type="text" name="type" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="text">Nombre de période</label>
            <select name="periodnum">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="2">4</option>
            </select>
        </div>
        <div class="form-group">
            <label for="text">Durée d'une période</label>
            <input id="text" type="number" name="periodduration" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i>&nbsp;&nbsp;Envoyer</button>
    </form>
</div>


{% endblock %}<?php
