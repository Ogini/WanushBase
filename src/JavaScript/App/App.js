import React from 'react';
import PropTypes from 'prop-types';
import { Card, Button } from 'react-bootstrap';

import image from '../../assets/static/Dancing-Mike.png';

class App extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            bodyText: props.body
        }
    }

    handleButtonPress = () => {
        fetch('/api/gettext')
            .then(response => response.json())
            .then(json => {
                if (json.success && json.text) {
                    this.setState({bodyText: json.text})
                }
            });
    };

    render() {
        return (
            <Card bg="dark" text="white" border="warning">
                <Card.Header>{this.props.header}</Card.Header>
                <Card.Img variant="top" src={image} />
                <Card.Body>
                    <Card.Title>{this.props.title}</Card.Title>
                    <Card.Text>{this.state.bodyText}</Card.Text>
                    {this.props.button && <Button variant="primary" onClick={this.handleButtonPress}>{this.props.button}</Button>}
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
