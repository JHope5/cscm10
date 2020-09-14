package spa;

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintStream;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class Algorithm {
	List<Student> allStudents;
	List<Project> allProjects;
	List<Lecturer> allLecturers;
	
	Algorithm() {
		allStudents = new ArrayList<Student>();
		allProjects = new ArrayList<Project>();
		allLecturers = new ArrayList<Lecturer>();
		
		try {
			Scanner s = new Scanner(new BufferedReader(new FileReader("in.txt")));
			
			// Get the students from input file
			int totalStudents = s.nextInt();
			for(int i = 1; i <= totalStudents; i++) {
				allStudents.add(new Student(i, s));
			}
			
			// Get the projects from the input file
			int totalProjects = s.nextInt();
			for(int i = 1; i <= totalProjects; i++) {
				allProjects.add(new Project(i, s));
			}
			
			// Adding projects to student's preference list
			for(Student si : allStudents) {
				for(int i = 0; i < si.totalPreferences(); i++) {
					si.addProjectToPreferenceList(findProjectByID(si.getProjectIDByIndex(i)));
				}
			}
			
			// Get the lecturers from the input file
			int totalLecturers = s.nextInt();
			for(int i = 0; i < totalLecturers; i++) {
				//System.out.println(s.nextInt());
				allLecturers.add(new Lecturer(i, s));
				
				// Getting lecturer preferences of students
				String lecturerPreferenceList = s.nextLine();
				String splitPreferences[] = lecturerPreferenceList.split(" ");
				// Adding students to lecturer's preference list
				for(String temp : splitPreferences) {
					allLecturers.get(i).addStudentToPreferenceList(findStudentByID(Integer.valueOf(temp)));
				}
				
				// Getting the projects offered by the Lecturer
				String projects = s.nextLine();
				String splitProjects[] = projects.split(" ");
				for(String temp : splitProjects) {
					Project pj = findProjectByID(Integer.valueOf(temp));
					allLecturers.get(i).addProject(pj);
					pj.setLecturer(allLecturers.get(i));
					
					for(int j = 0; j < allLecturers.get(i).totalPreferences(); j++) {
						if(allLecturers.get(i).getStudentByIndex(j).studentWantsProject(pj) == true) {
							pj.addStudentToList(allLecturers.get(i).getStudentByIndex(j));
						}
					}
				}
			}
		}
		
		catch(IOException e) {
			e.printStackTrace();
		}
	}
	
	public void runAllocation() {
		while(studentIsFreeWithNonEmptyList()) {
			Student si = getFreeStudentWithNonEmptyList();
			Project pj = si.getFirstPreference();
			Lecturer lk = getOfferingLecturer(pj);
			si.assignLecturer(lk);
			si.assignProject(pj);
			
			if(pj.isOverSubscribed()) {
				// Find the lowest ranked student who is allocated to the project
				Student lowestRanked = pj.getWorstAssignedStudent();
				lowestRanked.breakProvisionalAssignment();
			}
			
			else if (lk.isOverSubscribed()) {
				// Find the lowest ranked student assigned to a lecturer
				Student lowestRanked = lk.getWorstAssignedStudent();
				lowestRanked.breakProvisionalAssignment();
			}
			
			if(pj.isFull()) {
				// Find lowest ranked student allocated the project
				Student lowestRanked = pj.getWorstAssignedStudent();
				// Finding the student's position in the lecturer's preference list
				// to break the assignment
				for(int i = pj.getIndexOfStudent(si) + 1; i < pj.getTotalStudentsInList(); i++) {
					deletePair(pj.getStudentByIndex(i), pj);
				}
			}
			
			else if(lk.isFull()) {
				// Find lowest ranked student assigned to lecturer
				Student lowestRanked = lk.getWorstAssignedStudent();
				// Find the student's position in the lecturer's preference list
				// to break the assignment
				for(int i = lk.getStudentIndex(lowestRanked) + 1; i < lk.getTotalPreferences(); i++) {
					// For each of the projects offered by this lecturer, we remove it from
					// the student's preference list
					for(int j = 0; j < lk.getTotalProjects(); j++) {
						if(lk.getStudentByIndex(i).studentWantsProject(lk.getProjectByIndex(j))) {
							deletePair(lk.getStudentByIndex(i), lk.getProjectByIndex(j));
						}
					}
				}
			}
		}
		
		try {
			System.setOut(new PrintStream(new FileOutputStream("out.txt")));
			System.out.println(printSolution());
		}
		catch (FileNotFoundException e) {
			e.printStackTrace();
		}
	}
	
	/**
	 * Check if a student is still available
	 * @return True if student is free and has options in their list; False if not
	 */
	public boolean studentIsFreeWithNonEmptyList() {
		for(Student si : allStudents) {
			if(si.isFree()) {
				return true;
			}
		}
		return false;		
	}

	/**
	 * Get a student who does not yet have a project
	 * @return The student or null
	 */
	public Student getFreeStudentWithNonEmptyList() {
		for(Student si : allStudents) {
			if(si.isFree()) {
				return si;
			}
		}
		return null;
	}
	
	/**
	 * Get the lecturer who offers a project
	 * @param pj A Project
	 * @return The offering lecturer, or null
	 */
	public Lecturer getOfferingLecturer(Project pj) {
		for(Lecturer lk : allLecturers) {
			if(lk.offersProject(pj)) {
				return lk;
			}
		}
		return null;
	}
	
	/**
	 * Removing the possibility of a certain pair of Student and Project
	 * @param si A Student
	 * @param pj A Project
	 */
	public void deletePair(Student si, Project pj) {
		si.removeProjectFromPreferenceList(pj);
	}
	
	/**
	 * Returning a Project that has the given ID
	 * @param id
	 * @return The associated Project
	 */
	public Project findProjectByID(int id) {
		for(Project pj : allProjects) {
			if(pj.getID() == id) {
				return pj;
			}
		}
		return null;
	}
	
	/**
	 * Returning a Student that has a given ID
	 * @param id
	 * @return The associated Student
	 */
	public Student findStudentByID(int id) {
		for(Student si : allStudents) {
			if(si.getID() == id) {
				return si;
			}
		}
		return null;
	}
	
	public String printSolution() {
		String output = "";
		for(Student si : allStudents) {
			output += si.getUsername() + " ";
			if(si.getAllocatedProject() == null) {
				output += "N/A N/A\n";
			}
			else {
				output += si.getAllocatedProject().getCode()+" "+si.getAllocatedProject().getLecturer().getUsername() + "@swansea.ac.uk\n";
			}
			//output += "\n";
		}
		return output;
	}
}
