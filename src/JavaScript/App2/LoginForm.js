/*
 * Project: WanushBaseGH
 * File: LoginForm.js
 * Date: 31/10/2019, 15:31
 * Last Change; 31/10/2019, 15:31
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

import {Button, Form} from "react-bootstrap";
import * as PropTypes from "prop-types";
import React from "react";

function LoginForm(props) {
    return <Form noValidate validated={props.validated} onSubmit={props.onSubmit}>
        <Form.Group controlId="loginUsername">
            <Form.Label>Username</Form.Label>
            <Form.Control type="text" placeholder="Enter username" required name="username"/>
            <Form.Control.Feedback>Looks good!</Form.Control.Feedback>
        </Form.Group>
        <Form.Group controlId="loginPassword">
            <Form.Label>Password</Form.Label>
            <Form.Control type="password" placeholder="Password" required name="password"/>
            <Form.Control.Feedback>Looks good!</Form.Control.Feedback>
        </Form.Group>
        <Button variant="primary" type="submit">Login</Button>
    </Form>;
}

LoginForm.propTypes = {
    validated: PropTypes.any,
    onSubmit: PropTypes.func
};

export default LoginForm;