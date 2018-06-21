import React from 'react';
import Root from './src/native/index';
import configureStore from './src/store/index';

export default function App() {
  const { persistor, store } = configureStore();
  console.log(store)
  return <Root store={store} persistor={persistor} />;
}
