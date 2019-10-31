/*
 * Project: WanushBaseGH
 * File: App2Text.js
 * Date: 31/10/2019, 15:30
 * Last Change; 31/10/2019, 15:30
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

import {Button} from "react-bootstrap";
import * as PropTypes from "prop-types";
import React from "react";

function App2Text(props) {
    return <div>
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
        {props.loggedIn
            ? <Button variant="primary" onClick={props.onClick}>Test</Button>
            : <Button variant="primary" onClick={props.onClick1}>Login</Button>
        }
    </div>;
}

App2Text.propTypes = {
    loggedIn: PropTypes.any,
    onClick: PropTypes.func,
    onClick1: PropTypes.func
};

export default App2Text;