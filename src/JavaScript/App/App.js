/*
 * Project: WanushBaseGH
 * File: App.js
 * Date: 24/10/2019, 12:02
 * Last Change; 23/10/2019, 16:28
 *
 * @author Michael Wanush <mike@wanush.net>
 * @copyright 2019 Michael Wanush
 */

import React from 'react';
import PropTypes from 'prop-types';
import {Button, Card, Fade} from 'react-bootstrap';
import SlideTextTransformation from "../Transitions/SlideTextTransformation";

import image from '../../assets/static/Dancing-Mike-Crop.png';

class App extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            bodyText: props.body,
            show: true,
            newText: '',
            header: props.header,
            title: props.title
        }
    }

    changeText = () => {
        this.setState({show: true, bodyText: this.state.newText});
    };

    handleButtonPress = () => {
        fetch('/api/gettext')
            .then(response => response.json())
            .then(json => {
                if (json.success && json.text) {
                    this.setState({show: false, newText: json.text});
                }
            });
    };

    render() {
        return (
            <Card bg="dark" text="white" border="warning">
                <Card.Header>{this.state.header}</Card.Header>
                <Card.Img variant="top" src={image}/>
                <Card.Body>
                    <SlideTextTransformation show={this.state.show}>
                        <Card.Title>{this.state.title}</Card.Title>
                    </SlideTextTransformation>
                    <Fade appear={true} in={this.state.show} onExited={this.changeText}>
                        <Card.Text>{this.state.bodyText}</Card.Text>
                    </Fade>
                    {this.props.button &&
                    <Button variant="primary" onClick={this.handleButtonPress}>{this.props.button}</Button>}
                </Card.Body>
            </Card>
        )
    }
}

App.defaultProps = {
    header: 'Header',
    title: 'Title',
    body: 'Body'
};

App.propTypes = {
    header: PropTypes.string.isRequired,
    title: PropTypes.string.isRequired,
    body: PropTypes.string.isRequired,
    button: PropTypes.string
};

export default App;
