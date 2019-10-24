/*
 * Project: WanushBaseGH
 * File: App2.js
 * Date: 24/10/2019, 12:02
 * Last Change; 24/10/2019, 11:20
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

import React, {useState} from 'react';
import {Spinner, Button, Form} from 'react-bootstrap';

function App2() {
    const [show, setShow] = useState(false);
    const [login, setLogin] = useState(false);
    const [loggedIn, setLoggedIn] = useState(false);
    const [validated, setValidated] = useState(false);
    const [jwt, setJwt] = useState('');

    const handleLogin = event => {
        const form = event.currentTarget;
        event.preventDefault();
        if (form.checkValidity() === false) {
            event.stopPropagation();
        } else {
            const formFields = {
                username: form.username.value,
                password: form.password.value
            };
            fetch('/api/login', {
                method: 'post',
                body: JSON.stringify(formFields),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(json => {
                    if (json.success) {
                        setLoggedIn(true);
                        setLogin(false);
                        setShow(true);
                        setJwt(json.token);
                    }
                });
        }
        setValidated(true);
    };

    const testJwt = () => {
        fetch('/api/gettext', {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + jwt
            }
        })
            .then(response => response.json())
            .then(json => {
                console.log(json);
                if (json.token) {
                    setJwt(json.token);
                }
            });
    };

    if (show && !login) {
        return (
            <div>
                <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                    labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                    et earebum. Stetclita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem
                    ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
                    et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea
                    rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem
                    ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
                    et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea
                    rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                </p>
                {loggedIn
                    ? <Button variant="primary" onClick={() => testJwt()}>Test</Button>
                    : <Button variant="primary" onClick={() => setLogin(true)}>Login</Button>
                }
            </div>
        )
    } else if (login) {
        return (
            <Form noValidate validated={validated} onSubmit={handleLogin}>
                <Form.Group controlId="loginUsername">
                    <Form.Label>Username</Form.Label>
                    <Form.Control type="text" placeholder="Enter username" required name="username" />
                    <Form.Control.Feedback>Looks good!</Form.Control.Feedback>
                </Form.Group>
                <Form.Group controlId="loginPassword">
                    <Form.Label>Password</Form.Label>
                    <Form.Control type="password" placeholder="Password" required name="password" />
                    <Form.Control.Feedback>Looks good!</Form.Control.Feedback>
                </Form.Group>
                <Button variant="primary" type="submit">Login</Button>
            </Form>
        )
    } else {
        setTimeout(() => {
            setShow(true);
        }, 1000);
        return <Spinner animation="border" variant="info" />
    }
}

export default App2;
