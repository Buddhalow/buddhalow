import React from 'react';
import PropTypes from 'prop-types';
import { FlatList, TouchableOpacity, RefreshControl, Image } from 'react-native';
import { Container, Content, Card, CardItem, Body, Text, Button } from 'native-base';
import { Actions } from 'react-native-router-flux';
import gql from 'graphql-tag'
import Loading from './Loading';
import Error from './Error';
import Header from './Header';
import Spacer from './Spacer';

const ArchievementsComponent = ({
  error,
  loading,
  data,
  reFetch,
}) => {
  // Loading
  console.log(loading, data, error)
  if (loading || !data) return <Loading />; 

  // Error
  if (error) return <Error content={error} />;

  let archievements = data.archievements

  console.log(archievements)

  const keyExtractor = item => item.id; 

  const onPress = item => {};
  if (!archievements) return <Error content={'Archievements cannot be NULL'} />
  archievements = archievements.map (o => {
      return {
          id: o.id,
          name: o.archievementType.name
      }
  })
  return (
    <Container style={{'backgroundColor': '#fff'}}>
      <Content padder>
        <Header
          title="Archievements"
          content="Your archievements"
        />

        <FlatList
          numColumns={5}
          data={archievements}
          renderItem={({ item }) => (
            <Card transparent style={{ paddingHorizontal: 6, backgroundColor: '#FFaa00' }}>
              <CardItem cardBody style={{backgroundColor: '#FFaa00'}}>
                <Body>
                  <Text style={{ fontWeight: '800' }}>{item.name}</Text>
                 
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

ArchievementsComponent.propTypes = {
  error: PropTypes.string,
  loading: PropTypes.bool.isRequired,
  archievements: PropTypes.arrayOf(PropTypes.shape()).isRequired,
  reFetch: PropTypes.func,
};

ArchievementsComponent.defaultProps = {
  error: null,
  reFetch: null,
};

export default ArchievementsComponent;  
