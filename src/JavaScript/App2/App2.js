/*
 * Project: WanushBaseGH
 * File: App2.js
 * Date: 24/10/2019, 12:02
 * Last Change; 24/10/2019, 11:20
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

import React, {useState, useEffect} from 'react';
import {Spinner} from 'react-bootstrap';
import LoginForm from "./LoginForm";
import App2Text from "./App2Text";

const useStateWithLocalStorage = localStorageKey => {
    const [value, setValue] = useState(
        localStorage.getItem(localStorageKey) || ''
    );

    useEffect(() => {
        localStorage.setItem(localStorageKey, value);
    }, [value]);

    return [value, setValue];
};

function App2() {
    const [validated, setValidated] = useState(false);
    const [login, setLogin] = useState(false);
    const [jwt, setJwt] = useStateWithLocalStorage('jwt');
    const [loggedIn, setLoggedIn] = useState(jwt !== '');
    const [show, setShow] = useState(jwt !== '');

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
                if (json.token) {
                    setJwt(json.token);
                }
            });
    };

    if (show && !login) {
        return (
            <App2Text loggedIn={loggedIn} onClick={() => testJwt()} onClick1={() => setLogin(true)}/>
        )
    } else if (login) {
        return (
            <LoginForm validated={validated} onSubmit={handleLogin}/>
        )
    } else {
        setTimeout(() => {
            setShow(true);
        }, 1000);
        return <Spinner animation="border" variant="info" />
    }
}

export default App2;
