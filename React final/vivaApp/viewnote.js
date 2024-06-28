import {
  Button,
  SafeAreaView,
  StyleSheet,
  Text,
  View,
  FlatList,
  Image,
} from "react-native";
import React, { useEffect, useState } from "react";

export function ViewUI({ navigation, route }) {
  const [noteList, setNoteList] = useState([]);
 
  useEffect(() => {
    fetch(
      "http://192.168.1.112/vivaAppWeb/getnote.php?userId=" + route.params.id
    )
      .then((response) => response.json())
      .then((notes) => {
        setNoteList(notes);
      })
      .catch((error) => {
        console.error("Error", error);
      });
  }, []);

  const ui = (
    <SafeAreaView style={styles.container}>
      <View>
        <FlatList data={noteList} renderItem={userui}/>
      </View>
    </SafeAreaView>
  );

  function userui({item}){
   
   
      const uii = (
          <View>
            <Text>{item.title}</Text>
            <Text>{item.description}</Text>
            <Text>{item.date}</Text>
            {/* <Text>{item.imgpath}</Text> */}
                <Image
                style={{ width: 80, height: 80, objectFit: "contain" }}
                source={{ uri: item.imgpath }} 
                />
          </View>
      );
      return uii;
  }



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
  view1: {
   
    alignItems: "flex-end",
  },
  view2: {
    
    marginTop: 10,
    alignItems: "flex-start",
  },
  view: {
    backgroundColor: "red",
    marginTop: 10,
  },
});
