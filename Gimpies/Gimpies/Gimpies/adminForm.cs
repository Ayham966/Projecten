using System;
using System.Data;
using System.Data.SqlClient;
using System.Windows.Forms;

namespace Gimpies
{
    public partial class adminForm : Form
    {
        SqlConnection con = new SqlConnection(@"Data Source=(LocalDB)\MSSQLLocalDB;AttachDbFilename=C:\Users\NOOBMASTER69\Documents\dpGimp.mdf;Integrated Security=True;");
        DataSet DS = new System.Data.DataSet();
        SqlCommand cmd;
        public adminForm()
        {
            InitializeComponent();
        }


        private void adminForm_Load(object sender, EventArgs e)
        {
            DisplayUsers();
        }

     


        private void dataGridView_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
               ClearData();
            
            txtName.Text = this.dataGridView.CurrentRow.Cells[1].Value.ToString();
            txtTel.Text = this.dataGridView.CurrentRow.Cells[3].Value.ToString();
            txtEma.Text = this.dataGridView.CurrentRow.Cells[4].Value.ToString();
            txtAdr.Text = this.dataGridView.CurrentRow.Cells[5].Value.ToString();
            txtCity.Text = this.dataGridView.CurrentRow.Cells[6].Value.ToString();

          
        }


        private void addBtn_Click(object sender, EventArgs e)
        {
            if (txtName.Text != "" &&  txtTel.Text != "" && txtEma.Text != "" && txtAdr.Text != "" && txtCity.Text != "" )
            {
                for (int i = 0; i < dataGridView.Rows.Count; i++)
                {
                    for (int j = 0; j < dataGridView.Columns.Count; j++)
                    {
                        if (dataGridView.Rows[i].Cells[j].Value != null
                         && (txtName.Text == dataGridView.Rows[i].Cells[1].Value.ToString()
                              && txtTel.Text == dataGridView.Rows[i].Cells[3].Value.ToString()
                              && txtEma.Text == dataGridView.Rows[i].Cells[4].Value.ToString()
                              && txtAdr.Text == dataGridView.Rows[i].Cells[5].Value.ToString()
                               && txtCity.Text == dataGridView.Rows[i].Cells[6].Value.ToString()
                                )
                            )

                        {
                         MessageBox.Show("The User already existed!.");
                            
                            return;
                        }
                        if (txtEma.Text == dataGridView.Rows[i].Cells[4].Value.ToString())
                        {
                            MessageBox.Show("Email is already used!.");
                            return;
                        }
                        if (txtTel.Text == dataGridView.Rows[i].Cells[3].Value.ToString())
                        {
                            MessageBox.Show("Telefoon number is already used!.");
                            return;
                        }

                    }

                }
                    cmd = new SqlCommand("insert into Users(Name,Telnumber,Email,Adress,City) values(@Name,@Telnumber,@Email,@Adress,@City)", con);
                con.Open();
                cmd.Parameters.AddWithValue("@Name", txtName.Text);
                cmd.Parameters.AddWithValue("@Telnumber", txtTel.Text);
                cmd.Parameters.AddWithValue("@Email", txtEma.Text);
                cmd.Parameters.AddWithValue("@Adress", txtAdr.Text);
                cmd.Parameters.AddWithValue("@City", txtCity.Text);
                cmd.ExecuteNonQuery();
                con.Close();
                MessageBox.Show("Added Successfully");
                MessageBox.Show("We will send an Emile to set his/her Password!");
                DisplayUsers();
                ClearData();
            }
            else
            {
                MessageBox.Show("Please full all Details!");
            }
        }
        private void DisplayUsers()
        {
            con.Open();
            DataTable dt = new DataTable();
            SqlDataAdapter adapt = new SqlDataAdapter("select id,Name,Password,Telnumber,Email,Adress,City  from Users", con);
            adapt.Fill(dt);
            dataGridView.DataSource = dt;
            dataGridView.Columns["Id"].Visible = false;
            con.Close();
            for (int i = 0; i < dataGridView.Columns.Count; i++)
            {
                int col = dataGridView.Columns[i].Width;
                dataGridView.Columns[i].AutoSizeMode = DataGridViewAutoSizeColumnMode.Fill;

                dataGridView.Columns[i].Width = col;
            }
        }
       


        private void ClearData()
        {
            txtName.Text = "";
            txtTel.Text = "";
            txtEma.Text = "";
            txtAdr.Text = "";
            txtCity.Text = "";
        }

        private void button4_Click(object sender, EventArgs e)
        {
            this.Hide();
            var outlogin = new Form1();
            outlogin.ShowDialog();
            this.Hide();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            

            foreach (DataGridViewRow item in this.dataGridView.SelectedRows)
            {
                cmd = con.CreateCommand();
                int id = Convert.ToInt32(dataGridView.SelectedRows[0].Cells[0].Value);
                cmd.CommandText = "Delete from Users where id='" + id + "'";
                dataGridView.Rows.RemoveAt(this.dataGridView.SelectedRows[0].Index);
                con.Open();
                cmd.ExecuteNonQuery();
                con.Close();
                MessageBox.Show("User is deleted Successfully");
               
            }
            ClearData();


        }

        private void txtTel_TextChanged(object sender, EventArgs e)
        {
            if (System.Text.RegularExpressions.Regex.IsMatch(txtTel.Text, "[^0-9]"))
            {
                MessageBox.Show("Please enter only numbers.");
                txtTel.Text = txtTel.Text.Remove(txtTel.Text.Length - 1);
            }
        }



        private void button1_Click(object sender, EventArgs e)
        {

            int id = Convert.ToInt32(dataGridView.SelectedRows[0].Cells[0].Value);

            if (txtName.Text != "" &&  txtTel.Text != "" && txtEma.Text != "" && txtAdr.Text !="" && txtCity.Text != "" )
            {
                if (dataGridView.CurrentCell != null)
                {
                    cmd = new SqlCommand("update Users set  Name=@Name,Telnumber=@Telnumber,Email=@Email,Adress=@Adress,City=@City where ID=@id", con);
                    con.Open();

                    cmd.Parameters.AddWithValue("@id", id);
                    cmd.Parameters.AddWithValue("@Name", txtName.Text);
                    cmd.Parameters.AddWithValue("@Telnumber", txtTel.Text);
                    cmd.Parameters.AddWithValue("@Email", txtEma.Text);
                    cmd.Parameters.AddWithValue("@Adress", txtAdr.Text);
                    cmd.Parameters.AddWithValue("@City", txtCity.Text);
                    cmd.ExecuteNonQuery();
                    MessageBox.Show("Updated Successfully");
                    con.Close();
                    DisplayUsers();
                    ClearData();
                }
            }
            else
            {
                MessageBox.Show("Please Select User to Update");
            }
        }

        private void btnBack_Click(object sender, EventArgs e)
        {
            this.Hide();
            var back = new adminDash();
            back.ShowDialog();
            this.Close();
        }

        private void Form_Closing(object sender, FormClosingEventArgs e)
        {
            if (e.CloseReason == CloseReason.UserClosing)
            {
                if (MessageBox.Show("Are you sure you want to exit ?", "Confirmation",
                MessageBoxButtons.YesNo, MessageBoxIcon.Question) == DialogResult.Yes)
                { Application.Exit(); }
                else { e.Cancel = true; }
            }
        }

        private void dataGridView_CellFormatting(object sender, DataGridViewCellFormattingEventArgs e)
        {
            if (e.ColumnIndex == 2 && e.Value != null)
            {
                e.Value = new String('*', e.Value.ToString().Length);
            }
        }
    }
}


