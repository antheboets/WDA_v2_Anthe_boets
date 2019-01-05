package logic;

import java.io.*;
import java.util.ArrayList;

public class Main {
    public static void main(String[] args) {

        //

        //https://stackoverflow.com/questions/5694385/getting-the-filenames-of-all-files-in-a-folder
        File folder = new File("C:\\Users\\Anthe Boets\\Documents\\GitHub\\WDA_v2_Anthe_boets\\UI\\img\\country");
        File[] listOfFiles = folder.listFiles();
        File file = new File("C:\\Users\\Anthe Boets\\Desktop\\cont.txt");
        ArrayList<String> sqlQuery = new ArrayList<String>();


        try{

            BufferedReader br = new BufferedReader(new FileReader(file));
            String st;
            while ((st = br.readLine()) != null) {

                sqlQuery.add(st);
            }
        }catch (IOException e){
            System.out.println(e);
        }


// Read rows


        try{

            PrintWriter writer = new PrintWriter("C:\\Users\\Anthe Boets\\Documents\\GitHub\\WDA_v2_Anthe_boets\\Database\\sql\\country.sql", "UTF-8");

            for(int i = 0; i < listOfFiles.length ; i++){
                if(listOfFiles[i].isFile()) {
                    for(int j = 0; j < sqlQuery.size(); j++){
                        if(sqlQuery.get(j).substring(29,31).equals(listOfFiles[i].getName().substring(0,2).toUpperCase())){
                            writer.println(sqlQuery.get(j));
                        }
                    }
                }
            }

            writer.close();



        }catch (FileNotFoundException | UnsupportedEncodingException e1){
            System.out.println(e1);
        }
    }

}
