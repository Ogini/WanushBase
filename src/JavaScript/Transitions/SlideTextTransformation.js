/*
 * Project: WanushBaseGH
 * File: SlideTextTransformation.js
 * Date: 24/10/2019, 12:04
 * Last Change; 23/10/2019, 16:26
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

import React from 'react';
import {CSSTransition} from 'react-transition-group';

const SlideTextTransformation = props => {
    return (
        <CSSTransition appear={true} in={props.show} timeout={300} classNames="slidetext">
            {props.children}
        </CSSTransition>
    )
};

export default SlideTextTransformation
