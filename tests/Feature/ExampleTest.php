<?php

it('returns a successful response', function () {
    $response = $this->get('/');
    $response->assertRedirect('/movies');
    $response->assertStatus(302);
});
