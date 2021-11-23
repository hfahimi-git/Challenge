import java.util.ArrayList;
import java.util.Arrays;
import org.junit.Test;
import static org.junit.Assert.*;

public class FindRoutesTest {

    @Test
    public void fiveCityAcronyms() {
        assertEquals("MNL, TAG, CEB, TAC, BOR", Challenge.findRoutes(new ArrayList<ArrayList<String>>(Arrays.asList(new ArrayList<String>(Arrays.asList("MNL", "TAG")), new ArrayList<String>(Arrays.asList("CEB", "TAC")), new ArrayList<String>(Arrays.asList("TAG", "CEB")), new ArrayList<String>(Arrays.asList("TAC", "BOR"))))));
    }

    @Test
    public void sixFullCityNames() {
        assertEquals("Halifax, Montreal, Toronto, Chicago, Winnipeg, Seattle", Challenge.findRoutes(new ArrayList<ArrayList<String>>(Arrays.asList(new ArrayList<String>(Arrays.asList("Chicago", "Winnipeg")), new ArrayList<String>(Arrays.asList("Halifax", "Montreal")), new ArrayList<String>(Arrays.asList("Montreal", "Toronto")), new ArrayList<String>(Arrays.asList("Toronto", "Chicago")), new ArrayList<String>(Arrays.asList("Winnipeg", "Seattle"))))));
    }
}
