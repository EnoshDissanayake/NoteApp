import { Alert, Button, SafeAreaView, StyleSheet, Text, View } from "react-native";
import AsyncStorage from '@react-native-async-storage/async-storage';


export function HomeUI({ navigation, route }) {
  async function saveDataToLocalStorage() {
    Alert.alert("Logout")
    try {
        await AsyncStorage.removeItem('user');
        navigation.navigate("Login")
      } catch (error) {
        console.error('Error saving user data:', error);
      }
  }

  const ui = (
    <SafeAreaView style={styles.container}>
      <Text style={styles.text1}>home</Text>
      <Text>{route.params.first_name}</Text>
      <Text>{route.params.last_name}</Text>
      <Text>{route.params.type}</Text>
      <View>
        <Button onPress={()=>{navigation.navigate("Newnote",route.params)}}  title="Add New Note" />
      </View>
      <View>
        <Button onPress={()=>{navigation.navigate("Viewnote",route.params)}} title="View Note" />
      </View>
      <View>
        <Button onPress={()=>{saveDataToLocalStorage()}} title="LogOut" />
      </View>
    </SafeAreaView>
  );
  return ui;
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#fff",
    //   alignItems: 'center',
    //   justifyContent: 'center',
  },
  text1: {
    fontSize: 24,
    fontWeight: "bold",
  },
});
