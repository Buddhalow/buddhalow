import React from 'react';
import PropTypes from 'prop-types';
import { FlatList, TouchableOpacity, RefreshControl, Image } from 'react-native';
import { Container, Content, Card, CardItem, Body, Text, Button } from 'native-base';
import { Actions } from 'react-native-router-flux';
import gql from 'graphql-tag'
import { graphql, ApolloProvider } from 'react-apollo';
import Loading from './Loading';
import Error from './Error';
import Header from './Header';
import Spacer from './Spacer';
import { Query } from 'react-apollo'

const GET_NOTIFICATIONS = gql`
    query getNotifications {
       notifications {
           id,
           name,
           description,
           time
       } 
    }
`

const NotificationsComponent = ({
  error,
  data,
  reFetch,
}) => {
  // Loading
  
  if (!data || data.loading) return <Loading />;

  // Error
  if (data.error) return <Error content={error} />;

  const keyExtractor = item => item.id;

  const onPress = item => Actions.notification({ match: { params: { id: String(item.id) } } });

  return (
    <Container>
      <Content padder>
        <Header
          title="Notifications"
          content="Notifications from Buddhalow Music."
        />

        <FlatList
          numColumns={2}
          data={notifications}
          renderItem={({ item }) => (
            <Card transparent style={{ paddingHorizontal: 6 }}>
              <CardItem cardBody>
                <TouchableOpacity onPress={() => onPress(item)} style={{ flex: 1 }}>
                  <Image
                    source={{ uri: item.image_url }}
                    style={{
                      height: 100,
                      width: null,
                      flex: 1,
                      borderRadius: 5,
                    }}
                  />
                </TouchableOpacity>
              </CardItem>
              <CardItem cardBody>
                <Body>
                  <Spacer size={10} />
                  <Text style={{ fontWeight: '800' }}>{item.name}</Text>
                  <Spacer size={15} />
                  <Button
                    block
                    bordered
                    small
                    onPress={() => onPress(item)}
                  >
                    <Text>Vie</Text>
                  </Button>
                  <Spacer size={5} />
                </Body>
              </CardItem>
            </Card>
          )}
          keyExtractor={keyExtractor}
          refreshControl={
            <RefreshControl
              refreshing={loading}
              onRefresh={reFetch}
            />
          }
        />

        <Spacer size={20} />
      </Content>
    </Container>
  );
};

NotificationsComponent.propTypes = {
  error: PropTypes.string,
  loading: PropTypes.bool.isRequired,
  notifications: PropTypes.arrayOf(PropTypes.shape()).isRequired,
  reFetch: PropTypes.func,
};

NotificationsComponent.defaultProps = {
  error: null,
  reFetch: null,
};

export default NotificationsComponent;  
